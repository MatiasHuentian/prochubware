<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\WithCSVImport;
use App\Models\Process;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use PhpOffice\PhpWord\Exception\Exception;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\SimpleType\Jc;
use PhpOffice\PhpWord\Style\Font;
use PhpOffice\PhpWord\Element\TextRun;
use PhpOffice\PhpWord\Style\ListItem;

class ProcessController extends Controller
{
    use WithCSVImport;

    public function index()
    {
        abort_if(Gate::denies('process_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.process.index');
    }

    public function create()
    {
        abort_if(Gate::denies('process_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.process.create');
    }

    public function edit(Process $process)
    {
        abort_if(Gate::denies('process_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.process.edit', compact('process'));
    }

    public function show(Process $process)
    {
        abort_if(Gate::denies('process_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $process->load('owner', 'dependency', 'state', 'glosary', 'input', 'output', 'objectiveGroup');

        return view('admin.process.show', compact('process'));
    }

    public function pdfexport(Process $process)
    {
        $process->load('owner', 'dependency', 'state', 'glosary', 'input', 'output', 'objectiveGroup', 'activities.risks');

        $pdf = PDF::loadView('admin.process.pdf', compact('process'));
        return $pdf->stream();

        return view('admin.process.pdf_with_head', compact('process'));
    }


    public function wordExport(Process $process)
    {
        $style_spacing_one =  array('left' => 432, 'firstLine' => 288);
        $style_spacing_two =  array('left' => (432 * 2), 'firstLine' => (288 * 2));
        $style_spacing_thre =  array('left' => (432 * 3), 'firstLine' => (288 * 3));

        // Estilo de fuente personalizado
        $fontStyle = new Font();
        $fontStyle->setName('Arial');
        $fontStyle->setSize(12);

        // Agregar una lista
        $listStyle = array('listType' => ListItem::TYPE_NUMBER_NESTED, 'alignment' => Jc::LEFT);


        // Crear una nueva instancia de PhpWord
        $phpWord = new PhpWord();

        // Agregar una sección
        $section = $phpWord->addSection();

        // Estilo de fuente personalizado para el texto en negrita
        $boldFontStyle = new Font();
        $boldFontStyle->setName('Arial');
        $boldFontStyle->setSize(11);
        $boldFontStyle->setBold(true);

        // Estilo de fuente personalizado para el texto normal
        $normalFontStyle = new Font();
        $normalFontStyle->setName('Arial');
        $normalFontStyle->setSize(11);
        $normalFontStyle->setBold(false);

        // Añadir título al documento
        $titleFontStyle = new Font();
        $titleFontStyle->setName('Arial');
        $titleFontStyle->setSize(16); // Tamaño más grande
        $titleFontStyle->setBold(true); // Negrita
        $titleFontStyle->setUnderline('single'); // Subrayado

        $section->addText($process->name, $titleFontStyle, array('alignment' => Jc::CENTER));

        // Agregar dos saltos de línea después del título
        $section->addTextBreak(1);

        // Crear un TextRun para contener "Dueño del proceso:" y "$process->name"
        $textRun = $section->addTextRun();

        // Agregar "Dueño del proceso:" en negrita
        $textRun->addText("Dueño del proceso: ", $boldFontStyle);

        // Agregar "$process->name" en normal
        $textRun->addText($process->name, $normalFontStyle);

        // Agregar un salto de línea después del texto
        $section->addTextBreak(1);

        // Crear un TextRun para contener "Dirección: Transito, Dependencia: RRHH"
        $textRunDireccionDependencia = $section->addTextRun();

        // Agregar "Dirección:" en negrita
        $textRunDireccionDependencia->addText("Dirección: ", $boldFontStyle);

        // Agregar "Transito" en normal
        $textRunDireccionDependencia->addText($process->dependency->direction->name . ", ", $normalFontStyle);

        // Agregar ", Dependencia:" en negrita
        $textRunDireccionDependencia->addText("Dependencia: ", $boldFontStyle);

        // Agregar "RRHH" en normal
        $textRunDireccionDependencia->addText($process->dependency->name, $normalFontStyle);

        // Agregar un salto de línea después del texto
        $section->addTextBreak(1);


        // Definir las líneas de información a agregar
        $linesOfInformation = array(
            "Estado" => $process->state->name,
            "Fecha de inicio" => $process->start_date,
            "Fecha de término" => $process->end_date
        );

        // Agregar cada línea de información al documento
        foreach ($linesOfInformation as $label => $value) {
            // Crear un TextRun para contener la línea de información
            $textRun = $section->addTextRun();

            // Agregar el etiqueta en negrita
            $textRun->addText("$label: ", $boldFontStyle);

            // Agregar el valor en normal
            $textRun->addText($value, $normalFontStyle);

            // Agregar un salto de línea después del texto
            $section->addTextBreak(1);
        }

        // Crear un TextRun para contener "Memo contextual:" y el texto del proceso
        $textRunMemoContextual = $section->addTextRun();

        // Agregar "Memo contextual:" en negrita
        $textRunMemoContextual->addText("Memo contextual: ", $boldFontStyle);

        // Agregar el texto del proceso ({{$process->contextual_memo}}) en normal
        $textRunMemoContextual->addText($process->contextual_memo, $normalFontStyle);

        // Agregar un salto de línea después del texto
        $section->addTextBreak(1);

        // Crear un TextRun para contener "Introducción:" y el texto del proceso
        $textIntroduccion = $section->addTextRun();

        // Agregar "Introducción:" en negrita
        $textIntroduccion->addText("Introducción: ", $boldFontStyle);

        // Agregar el texto del proceso ({{$process->introduction}}) en normal
        $textIntroduccion->addText($process->introduction, $normalFontStyle);

        // Agregar un salto de línea después del texto
        $section->addTextBreak(1);

        // Crear un TextRun para contener "Glosario:" y la lista de palabras del glosario
        $textRunGlosario = $section->addTextRun();

        // Agregar "Glosario:" en negrita
        $textRunGlosario->addText("Glosario: ", $boldFontStyle);

        // Agregar una lista numerada para el glosario
        $listStyleGlosary = array('listType' => ListItem::TYPE_NUMBER_NESTED);

        // Agregar cada palabra con su definición a la lista
        foreach ($process->glosary->pluck('pivot.description', 'term') as $palabra => $definicion) {
            $section->addListItem("$palabra: $definicion", 0, $normalFontStyle);
        }

        // Crear un TextRun para contener "Memo contextual:" y el texto del proceso
        $textObjetivo = $section->addTextRun();

        // Agregar "Introducción:" en negrita
        $textObjetivo->addText("Objetivo: ", $boldFontStyle);

        // Agregar el texto del proceso ({{$process->objective}}) en normal
        $textObjetivo->addText($process->objective, $normalFontStyle);

        // Crear un TextRun para contener "Input:" y la lista de palabras del Input
        // $textRunInput = $section->addTextRun();

        // Sección para las entradas (input)
        $section->addText("Entradas:", $boldFontStyle);

        // Agregar una lista numerada para las entradas
        $listStyleInput = array('listType' => ListItem::TYPE_NUMBER_NESTED);
        foreach ($process->input->pluck('pivot.description', 'name') as $palabra => $definicion) {
            $section->addListItem("$palabra: $definicion", 0, $normalFontStyle);
        }

        $section->addText("Actividades:", $boldFontStyle);
        foreach ($process->activities  as $activity) {

            $section->addListItem("$activity->name: $activity->description", 0, $normalFontStyle);
            if ($activity->risks->count() > 0) {
                $section->addListItem("Riesgos de $activity->name", 0, $boldFontStyle, $boldFontStyle);
            }
            foreach ($activity->risks as $risk) {
                // $section->addText("Nombre: " . $risk->name, $normalFontStyle, array('indentation' => $style_spacing_two));
                $section->addText("Nombre: $risk->name", $normalFontStyle, array('indentation' => $style_spacing_two));
                $section->addText("Política: " . $risk->politic->name, $normalFontStyle, array('indentation' => $style_spacing_two));
                $section->addText("Probabilidad: " . $risk->probability->name, $normalFontStyle, array('indentation' => $style_spacing_two));
                $section->addText("Impacto: " . $risk->impact->name, $normalFontStyle, array('indentation' => $style_spacing_two));
                $section->addText("Descripción: $risk->description", $normalFontStyle, array('indentation' => $style_spacing_two));
                if ($risk->causes->count() > 0) {
                    $section->addListItem("Causas de riesgo $risk->name:", 0, $boldFontStyle, $boldFontStyle);
                }
                foreach ($risk->causes as $cause) {
                    $section->addText("Nombre: $cause->name", $normalFontStyle, array('indentation' => $style_spacing_two));
                    $section->addText("Descripción: $cause->description", $normalFontStyle, array('indentation' => $style_spacing_two));
                }

                if ($risk->consequences->count() > 0) {
                    $section->addListItem("Consecuencias de riesgo $risk->name:", 0, $boldFontStyle, $boldFontStyle);
                }
                foreach ($risk->consequences as $consequence) {
                    $section->addText("Nombre: $consequence->name", $normalFontStyle, array('indentation' => $style_spacing_two));
                    $section->addText("Descripción: $consequence->description", $normalFontStyle, array('indentation' => $style_spacing_two));
                }

                if ($risk->controls->count() > 0) {
                    $section->addListItem("Controles de riesgo $risk->name:", 0, $boldFontStyle, $boldFontStyle);
                }
                foreach ($risk->controls as $consequence) {
                    $section->addText("Nombre: $consequence->name", $normalFontStyle, array('indentation' => $style_spacing_two));
                    $section->addText("Frecuencia: " . $consequence->frecuency->name, $normalFontStyle, array('indentation' => $style_spacing_two));
                    $section->addText("Tecnología: " . $consequence->method->name, $normalFontStyle, array('indentation' => $style_spacing_two));
                    $section->addText("Tipo: " . $consequence->type->name, $normalFontStyle, array('indentation' => $style_spacing_two));
                }
                $section->addTextBreak();
            }
        }


        $textRun = $section->addTextRun();

        // Agregar "KPI'S:" en negrita
        $textRun->addText("KPI'S: ", $boldFontStyle);
        foreach ($process->kpis as $i => $kpi) {
            $num = $i + 1;
            $section->addListItem("KPI N°$num: $definicion", 0, $normalFontStyle);
            $section->addText("Nombre: $kpi->name", $normalFontStyle, array('indentation' => $style_spacing_one));
            $section->addText("Descripción de KPI N°$num: $kpi->description", $normalFontStyle, array('indentation' => $style_spacing_one));
            $section->addText("Forma de cálculo KPI N°$num: $kpi->calculate_form", $normalFontStyle, array('indentation' => $style_spacing_one));
            $section->addText("Ubicación de datos KPI N°$num: $kpi->ubication_data", $normalFontStyle, array('indentation' => $style_spacing_one));
        }


        // Sección para Los grupos objetivos (grupos objetivos)
        $section->addText("Grupos objetivos:", $boldFontStyle);

        foreach ($process->objectiveGroup->pluck('pivot.description', 'name') as $palabra => $definicion) {
            $section->addListItem("$palabra: $definicion", 0, $normalFontStyle);
        }

        $textRun = $section->addTextRun();

        // Agregar "Propuestas de mejoras:" en negrita
        $textRun->addText("Propuestas de mejoras: ", $boldFontStyle);
        foreach ($process->upgrades_proposals as $i => $proposal) {
            $num = $i + 1;
            $section->addListItem("Propuesta de mejora N°$num: $definicion", 0, $normalFontStyle);
            $section->addText("Estado: ". $proposal->status->name, $normalFontStyle, array('indentation' => $style_spacing_one));
            $section->addText("Descripción: $proposal->description", $normalFontStyle, array('indentation' => $style_spacing_one));
            $section->addText("Deadline: $proposal->deadline", $normalFontStyle, array('indentation' => $style_spacing_one));
        }


        // dd($process->kpis);




        // Probando el temita de lo de las 5 probando ando




        // // Sección para el glosario
        // $sectionGlosario = $section->addTextRun();
        // $sectionGlosario->addText("Glosario:", $boldFontStyle);

        // // Crear un nuevo estilo de lista numerada para el glosario
        // $glosarioListStyle = array('listType' => ListItem::TYPE_NUMBER_NESTED);
        // $phpWord->addNumberingStyle(
        //     'glosario',
        //     $glosarioListStyle
        // );

        // // Agregar una lista numerada para el glosario
        // foreach ($glosario as $palabra => $definicion) {
        //     $sectionGlosario->addListItem("$palabra: $definicion", 0, $normalFontStyle, 'glosario');
        // }

        // $textObjetivo = $section->addTextRun();

        // $entradas = $process->input->pluck('pivot.description', 'name');
        // // Sección para las entradas (input)
        // $sectionInput = $section->addTextRun();
        // $sectionInput->addText("Entradas:", $boldFontStyle);

        // // Crear un nuevo estilo de lista numerada para las entradas
        // $inputListStyle = array('listType' => ListItem::TYPE_NUMBER_NESTED);
        // $phpWord->addNumberingStyle(
        //     'input',
        //     $inputListStyle
        // );

        // // Agregar una lista numerada para las entradas
        // foreach ($entradas as $palabra => $definicion) {
        //     $sectionInput->addListItem("$palabra: $definicion", 0, $normalFontStyle, 'input');
        // }

        // $textObjetivo = $section->addTextRun();

        // $salidas = $process->output->pluck('pivot.description', 'name');
        // // Sección para las salidas (output)
        // $sectionOutput = $section->addTextRun();
        // $sectionOutput->addText("salidas:", $boldFontStyle);

        // // Crear un nuevo estilo de lista numerada para las salidas
        // $inputListStyle = array('listType' => ListItem::TYPE_NUMBER_NESTED);
        // $phpWord->addNumberingStyle(
        //     'input',
        //     $inputListStyle
        // );

        // // Agregar una lista numerada para las salidas
        // foreach ($salidas as $palabra => $definicion) {
        //     $sectionOutput->addListItem("$palabra: $definicion", 0, $normalFontStyle, 'output');
        // }




















        // $section->addTextBreak(20);

        // // Texto con estilo diferente
        // $section->addText('Este es un texto con estilo diferente:', $fontStyle);

        // // Texto con parte en negrita y parte normal en la misma línea
        // $textRun = $section->addTextRun();
        // $textRun->addText("Dueño del proceso: ", array('bold' => true));
        // $textRun->addText("juanito alimaña", $fontStyle);

        // // Agregar una lista
        // $section->addText("Lista:", $fontStyle);
        // $section->addListItem('Elemento 1', 0, $fontStyle, $listStyle);
        // $section->addListItem('Elemento 2', 0, $fontStyle, $listStyle);
        // $section->addListItem('Elemento 3', 0, $fontStyle, $listStyle);

        // // Agregar una sublista
        // $section->addText("Sublista:", $fontStyle);
        // $subListStyle = array('listType' => ListItem::TYPE_BULLET_FILLED, 'alignment' => Jc::LEFT);
        // $section->addListItem('Subelemento 1', 1, $fontStyle, $subListStyle);
        // $section->addListItem('Subelemento 2', 1, $fontStyle, $subListStyle);
        // $section->addListItem('Subelemento 3', 1, $fontStyle, $subListStyle);

        // Guardar el documento
        $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
        $fileName = 'documento_ejemplo.docx';
        $objWriter->save(storage_path('app/public/' . $fileName));

        return response()->download(storage_path('app/public/' . $fileName))->deleteFileAfterSend(true);
    }

    // public function wordExport(Process $process)
    // {

    //     // use PhpOffice\PhpWord\Exception\Exception;
    //     // use PhpOffice\PhpWord\IOFactory;
    //     // use PhpOffice\PhpWord\PhpWord;
    //     // use PhpOffice\PhpWord\Style\Font;
    //     // use PhpOffice\PhpWord\Style\ListItem;

    //     abort_if(Gate::denies('process_export_word'), Response::HTTP_FORBIDDEN, '403 Forbidden');
    //     // dd( $process->owner->Admintest );
    //     try{

    //         $phpWord = new PhpWord();
    //         // Adding an empty Section to the document...
    //         $section = $phpWord->addSection();

    //         // Título text
    //         $style_titulo_principal = array(
    //             'name' => 'Arial',
    //             'size' => 12,
    //             'bold' => true,
    //             'underline' => 'single', // Subrayado
    //             'alignment' => 'center', // Centrado
    //         );

    //         $titutlos_secundarios = array(
    //             'name' => 'Arial',
    //             'size' => 10,
    //             'bold' => true,
    //         );

    //         // Crea un estilo para el párrafo de la lista enumerada
    //         $styleList = array(
    //             'listType' => ListItem::TYPE_NUMBER_NESTED,
    //             'alignment' => 'left',
    //         );

    //         // Adding Text element to the Section having font styled by default...
    //         $section->addText(
    //             strtoupper($process->name) ,
    //             $style_titulo_principal , array('alignment' => 'center')
    //         );

    //         $section->addTextBreak(2);

    //         if ($process->owner) {
    //             $section->addText(
    //                 "Dueño: " . $process->owner->name ,
    //                 $titutlos_secundarios , []
    //             );
    //             $section->addTextBreak(1);
    //         }



    //         // Combina el estilo original con negrita

    //         // Combina el estilo original con negrita
    //         $phpWord->addFontStyle(
    //             'item_titles',
    //             array('name' => 'arial', 'size' => 10, 'color' => '1B2232', 'bold' => true)
    //         );

    //         // Agrega la línea enumerada con el texto 'INTRODUCCIÓN' y los estilos combinados
    //         $section->addListItem('INTRODUCCIÓN', 0, 'item_titles', $styleList);


    //         // Adding Text element with font customized inline...
    //         $section->addText(
    //             '"Great achievement is usually born of great sacrifice, '
    //                 . 'and is never the result of selfishness." '
    //                 . '(Napoleon Hill)',
    //             array('name' => 'Arial', 'size' => 10 ,)
    //         );


    //         $section->addTextBreak(2);

    //         // Adding Text element with font customized using explicitly created font style object...
    //         $fontStyle = new Font();
    //         $fontStyle->setBold(true);
    //         $fontStyle->setName('Tahoma');
    //         $fontStyle->setSize(13);
    //         $myTextElement = $section->addText('"Believe you can and you\'re halfway there." (Theodor Roosevelt)');
    //         $myTextElement->setFontStyle($fontStyle);

    //         // Saving the document as OOXML file...
    //         $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
    //         // dd( $process->name );
    //         $fileName = $process->name;
    //         $objWriter->save("proceso_$fileName.docx");
    //         return response()->download("proceso_$fileName.docx")->deleteFileAfterSend(true);
    //         return "wordExport";
    //     }catch ( Exception $e ){
    //         dd( $e->getCode());
    //     }
    // }

    public function __construct()
    {
        $this->csvImportModel = Process::class;
    }
}
