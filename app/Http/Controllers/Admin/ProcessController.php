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
use PhpOffice\PhpWord\Style\Font;
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

        abort_if(Gate::denies('process_export_word'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        try{

            $phpWord = new PhpWord();
            // Adding an empty Section to the document...
            $section = $phpWord->addSection();

            // Título text
            $style_titulo = array(
                'name' => 'Arial',
                'size' => 10,
                'bold' => true,
                'underline' => 'single', // Subrayado
                'alignment' => 'center', // Centrado
            );

            // Adding Text element to the Section having font styled by default...
            $section->addText(
                "PROCESO DE ". strtoupper($process->name) ,
                $style_titulo , array('alignment' => 'center')
            );

            $section->addTextBreak(2);

            // Combina el estilo original con negrita

            // Crea un estilo para el párrafo de la lista enumerada
            $styleList = array(
                'listType' => ListItem::TYPE_NUMBER_NESTED,
                'alignment' => 'left',
            );

            // Combina el estilo original con negrita
            $phpWord->addFontStyle(
                'item_titles',
                array('name' => 'arial', 'size' => 10, 'color' => '1B2232', 'bold' => true)
            );

            // Agrega la línea enumerada con el texto 'INTRODUCCIÓN' y los estilos combinados
            $section->addListItem('INTRODUCCIÓN', 0, 'item_titles', $styleList);


            // Adding Text element with font customized inline...
            $section->addText(
                '"Great achievement is usually born of great sacrifice, '
                    . 'and is never the result of selfishness." '
                    . '(Napoleon Hill)',
                array('name' => 'Arial', 'size' => 10 ,)
            );

            // Adding Text element with font customized using named font style...
            $fontStyleName = 'oneUserDefinedStyle';
            $phpWord->addFontStyle(
                $fontStyleName,
                array('name' => 'Tahoma', 'size' => 10, 'color' => '1B2232', 'bold' => true)
            );
            $section->addText(
                '"The greatest accomplishment is not in never falling, '
                    . 'but in rising again after you fall." '
                    . '(Vince Lombardi)',
                $fontStyleName
            );

            // Adding Text element with font customized using explicitly created font style object...
            $fontStyle = new Font();
            $fontStyle->setBold(true);
            $fontStyle->setName('Tahoma');
            $fontStyle->setSize(13);
            $myTextElement = $section->addText('"Believe you can and you\'re halfway there." (Theodor Roosevelt)');
            $myTextElement->setFontStyle($fontStyle);

            // Saving the document as OOXML file...
            $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
            // dd( $process->name );
            $fileName = $process->name;
            $objWriter->save("proceso_$fileName.docx");
            return response()->download("proceso_$fileName.docx")->deleteFileAfterSend(true);
            return "wordExport";
        }catch ( Exception $e ){
            dd( $e->getCode());
        }
    }

    public function __construct()
    {
        $this->csvImportModel = Process::class;
    }
}
