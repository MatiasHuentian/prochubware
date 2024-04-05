<div>
    <nav"
        class="
        md:fixed md:top-0 md:bottom-0 md:block md:left-0 md:overflow-y-auto md:flex-row md:flex-nowrap md:overflow-hidden
        shadow-xl bg-white flex flex-wrap items-center justify-between relative  z-10 py-4 px-6 duration-300"
        :class="isOpen ? 'md:w-64' : 'md:w-20'">
        <div
            class="md:flex-col md:items-stretch md:min-h-full md:flex-nowrap px-0 flex flex-wrap items-center justify-between w-full mx-auto">
            <button
                class="cursor-pointer text-black opacity-50 md:hidden px-3 py-1 text-xl leading-none bg-transparent rounded border border-solid border-transparent"
                type="button" onclick="toggleNavbar('example-collapse-sidebar')">
                <i class="fas fa-bars"></i>
            </button>
            <div class="md:flex items-center justify-between md:w-full sm:w-0">
                <a class="inline-block text-left md:pb-2 text-blueGray-700 mr-0  whitespace-nowrap text-sm uppercase font-bold p-4 px-0 "
                    :class="isOpen ? 'md:block' : 'md:hidden'" href="{{ route('admin.home') }}">
                    {{ trans('panel.site_title') }}
                </a>
                <i @click="isOpen = !isOpen" class="fas fa-arrow-right ml-auto -mr-2 cursor-pointer"
                    :class="isOpen ? 'rotate-180' : 'rotate-360'"></i>
            </div>

            <div class="md:flex md:flex-col md:items-stretch md:opacity-100 md:relative md:mt-4 md:shadow-none shadow absolute top-0 left-0 right-0 z-40 overflow-y-auto overflow-x-hidden h-auto items-center flex-1 rounded hidden"
                id="example-collapse-sidebar">
                <div class="md:min-w-full md:hidden block pb-4 mb-4 border-b border-solid border-blueGray-300">
                    <div class="flex flex-wrap">
                        <div class="w-6/12">
                            <a class="md:block text-left md:pb-2 text-blueGray-700 mr-0 inline-block whitespace-nowrap text-sm uppercase font-bold p-4 px-0"
                                href="{{ route('admin.home') }}">
                                {{ trans('panel.site_title') }}
                            </a>
                        </div>
                        <div class="w-6/12 flex justify-end">
                            <button type="button"
                                class="cursor-pointer text-black opacity-50 md:hidden px-3 py-1 text-xl leading-none bg-transparent rounded border border-solid border-transparent"
                                onclick="toggleNavbar('example-collapse-sidebar')">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </div>



                <div class="flex md:hidden">
                    @if (file_exists(app_path('Http/Livewire/LanguageSwitcher.php')))
                        <livewire:language-switcher />
                    @endif
                </div>
                <hr class="mb-6 md:min-w-full" />

                <ul class="md:flex-col md:min-w-full flex flex-col list-none">
                    <li class="items-center">
                        <a href="{{ route('admin.home') }}"
                            class="flex items-center {{ request()->is('admin') ? 'sidebar-nav-active' : 'sidebar-nav' }}">
                            <i class="fas fa-tv mr-2"></i> <!-- Icono con margen a la derecha -->
                            <span class="flex-grow" x-show.transition="isOpen">
                                {{ trans('global.dashboard') }} <!-- Texto del dashboard -->
                            </span>
                        </a>
                    </li>


                    @can('user_management_access')
                        <li class="items-center">
                            <a class="has-sub {{ request()->is('admin/permissions*') || request()->is('admin/roles*') || request()->is('admin/users*') ? 'sidebar-nav-active' : 'sidebar-nav' }}"
                                href="#" onclick="window.openSubNav(this)">
                                <i class="fa-fw fas c-sidebar-nav-icon fa-users">
                                </i>
                                <span class="flex-grow" x-show.transition="isOpen">
                                    {{ trans('cruds.userManagement.title') }}
                                </span>
                            </a>
                            <ul class="ml-4 subnav hidden">
                                @can('permission_access')
                                    <li class="items-center">
                                        <a class="{{ request()->is('admin/permissions*') ? 'sidebar-nav-active' : 'sidebar-nav' }}"
                                            href="{{ route('admin.permissions.index') }}">
                                            <i class="fa-fw c-sidebar-nav-icon fas fa-unlock-alt">
                                            </i>
                                            <span class="flex-grow" x-show.transition="isOpen">
                                                {{ trans('cruds.permission.title') }}
                                            </span>
                                        </a>
                                    </li>
                                @endcan
                                @can('role_access')
                                    <li class="items-center">
                                        <a class="{{ request()->is('admin/roles*') ? 'sidebar-nav-active' : 'sidebar-nav' }}"
                                            href="{{ route('admin.roles.index') }}">
                                            <i class="fa-fw c-sidebar-nav-icon fas fa-briefcase">
                                            </i>
                                            <span class="flex-grow" x-show.transition="isOpen">
                                                {{ trans('cruds.role.title') }}
                                            </span>
                                        </a>
                                    </li>
                                @endcan
                                @can('user_access')
                                    <li class="items-center">
                                        <a class="{{ request()->is('admin/users*') ? 'sidebar-nav-active' : 'sidebar-nav' }}"
                                            href="{{ route('admin.users.index') }}">
                                            <i class="fa-fw c-sidebar-nav-icon fas fa-user">
                                            </i>
                                            <span class="flex-grow" x-show.transition="isOpen">
                                                {{ trans('cruds.user.title') }}
                                            </span>
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcan
                    @can('process_menu_access')
                        <li class="items-center">
                            <a class="has-sub {{ request()->is('admin/processes*') || request()->is('admin/processes-activities*') || request()->is('admin/processes-states*') || request()->is('admin/processes-kpis*') ? 'sidebar-nav-active' : 'sidebar-nav' }}"
                                href="#" onclick="window.openSubNav(this)">
                                <i class="fa-fw fas c-sidebar-nav-icon fa-cogs">
                                </i>
                                <span class="flex-grow" x-show.transition="isOpen">
                                    {{ trans('cruds.processMenu.title') }}
                                </span>
                            </a>
                            <ul class="ml-4 subnav hidden">
                                @can('process_access')
                                    <li class="items-center">
                                        <a class="{{ request()->is('admin/processes*') ? 'sidebar-nav-active' : 'sidebar-nav' }}"
                                            href="{{ route('admin.processes.index') }}">
                                            <i class="fa-fw c-sidebar-nav-icon fas fa-cogs">
                                            </i>
                                            <span class="flex-grow" x-show.transition="isOpen">
                                                {{ trans('cruds.process.title') }}
                                            </span>
                                        </a>
                                    </li>
                                @endcan
                                @can('processes_activity_access')
                                    <li class="items-center">
                                        <a class="{{ request()->is('admin/processes-activities*') ? 'sidebar-nav-active' : 'sidebar-nav' }}"
                                            href="{{ route('admin.processes-activities.index') }}">
                                            <i class="fa-fw c-sidebar-nav-icon fas fa-tasks">
                                            </i>
                                            <span class="flex-grow" x-show.transition="isOpen">
                                                {{ trans('cruds.processesActivity.title') }}
                                            </span>
                                        </a>
                                    </li>
                                @endcan
                                @can('processes_state_access')
                                    <li class="items-center">
                                        <a class="{{ request()->is('admin/processes-states*') ? 'sidebar-nav-active' : 'sidebar-nav' }}"
                                            href="{{ route('admin.processes-states.index') }}">
                                            <i class="fa-fw c-sidebar-nav-icon fas fa-circle">
                                            </i>
                                            <span class="flex-grow" x-show.transition="isOpen">
                                                {{ trans('cruds.processesState.title') }}
                                            </span>
                                        </a>
                                    </li>
                                @endcan
                                @can('processes_kpi_access')
                                    <li class="items-center">
                                        <a class="{{ request()->is('admin/processes-kpis*') ? 'sidebar-nav-active' : 'sidebar-nav' }}"
                                            href="{{ route('admin.processes-kpis.index') }}">
                                            <i class="fa-fw c-sidebar-nav-icon fas fa-chart-bar">
                                            </i>
                                            <span class="flex-grow" x-show.transition="isOpen">
                                                {{ trans('cruds.processesKpi.title') }}
                                            </span>
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcan

                    <li class="items-center">
                        <a class="has-sub {{ request()->is('admin/directions*') || request()->is('admin/dependencies*') || request()->is('admin/processes-upgrade-proposals*') || request()->is('admin/upgrade-proposals-states*') || request()->is('admin/attachments*') || request()->is('admin/attachments-categories*') ||  request()->is('admin/inputs*') || request()->is('admin/glossaries*') || request()->is('admin/outputs*') || request()->is('admin/obejctives-groups*') || request()->is('admin/activities-risks*') || request()->is('admin/activities-risks-politics*') || request()->is('admin/activities-risks-probabilities*') || request()->is('admin/activities-risks-impacts*') || request()->is('admin/activities-risks-causes*') || request()->is('admin/activities-risks-consequences*') || request()->is('admin/risks-controls*') || request()->is('admin/risks-controls-types*') || request()->is('admin/risks-controls-frecuencies*') || request()->is('admin/risks-controls-methods*') ? 'sidebar-nav-active' : 'sidebar-nav' }}"
                            href="#" onclick="window.openSubNav(this)">
                            <i class="fa-fw fas c-sidebar-nav-icon fa-cogs">
                            </i>
                            <span class="flex-grow" x-show.transition="isOpen">
                                Entidades adicionales
                            </span>
                        </a>
                        <ul class="ml-4 subnav hidden">
                            @can('tablas_maestra_access')
                                <li class="items-center">
                                    <a class="has-sub {{ request()->is('admin/directions*') || request()->is('admin/dependencies*') ? 'sidebar-nav-active' : 'sidebar-nav' }}"
                                        href="#" onclick="window.openSubNav(this)">
                                        <i class="fa-fw fas c-sidebar-nav-icon fa-table">
                                        </i>
                                        <span class="flex-grow" x-show.transition="isOpen">
                                            {{ trans('cruds.tablasMaestra.title') }}
                                        </span>
                                    </a>
                                    <ul class="ml-4 subnav hidden">
                                        @can('direction_access')
                                            <li class="items-center">
                                                <a class="{{ request()->is('admin/directions*') ? 'sidebar-nav-active' : 'sidebar-nav' }}"
                                                    href="{{ route('admin.directions.index') }}">
                                                    <i class="fa-fw c-sidebar-nav-icon fas fa-briefcase">
                                                    </i>
                                                    <span class="flex-grow" x-show.transition="isOpen">
                                                        {{ trans('cruds.direction.title') }}
                                                    </span>
                                                </a>
                                            </li>
                                        @endcan
                                        @can('dependency_access')
                                            <li class="items-center">
                                                <a class="{{ request()->is('admin/dependencies*') ? 'sidebar-nav-active' : 'sidebar-nav' }}"
                                                    href="{{ route('admin.dependencies.index') }}">
                                                    <i class="fa-fw c-sidebar-nav-icon fas fa-sitemap">
                                                    </i>
                                                    <span class="flex-grow" x-show.transition="isOpen">
                                                        {{ trans('cruds.dependency.title') }}
                                                    </span>
                                                </a>
                                            </li>
                                        @endcan
                                    </ul>
                                </li>
                            @endcan
                            @can('propuesta_mejora_access')
                                <li class="items-center">
                                    <a class="has-sub {{ request()->is('admin/processes-upgrade-proposals*') || request()->is('admin/upgrade-proposals-states*') ? 'sidebar-nav-active' : 'sidebar-nav' }}"
                                        href="#" onclick="window.openSubNav(this)">
                                        <i class="fa-fw fas c-sidebar-nav-icon fa-cogs">
                                        </i>
                                        <span class="flex-grow" x-show.transition="isOpen">
                                            {{ trans('cruds.propuestaMejora.title') }}
                                        </span>
                                    </a>
                                    <ul class="ml-4 subnav hidden">
                                        @can('processes_upgrade_proposal_access')
                                            <li class="items-center">
                                                <a class="{{ request()->is('admin/processes-upgrade-proposals*') ? 'sidebar-nav-active' : 'sidebar-nav' }}"
                                                    href="{{ route('admin.processes-upgrade-proposals.index') }}">
                                                    <i class="fa-fw c-sidebar-nav-icon fas fa-lightbulb">
                                                    </i>
                                                    <span class="flex-grow" x-show.transition="isOpen">
                                                        {{ trans('cruds.processesUpgradeProposal.title') }}
                                                    </span>
                                                </a>
                                            </li>
                                        @endcan
                                        @can('upgrade_proposals_state_access')
                                            <li class="items-center">
                                                <a class="{{ request()->is('admin/upgrade-proposals-states*') ? 'sidebar-nav-active' : 'sidebar-nav' }}"
                                                    href="{{ route('admin.upgrade-proposals-states.index') }}">
                                                    <i class="fa-fw c-sidebar-nav-icon fas fa-circle">
                                                    </i>
                                                    <span class="flex-grow" x-show.transition="isOpen">
                                                        {{ trans('cruds.upgradeProposalsState.title') }}
                                                    </span>
                                                </a>
                                            </li>
                                        @endcan
                                    </ul>
                                </li>
                            @endcan
                            @can('attachmentsfile_access')
                                <li class="items-center">
                                    <a class="has-sub {{ request()->is('admin/attachments*') || request()->is('admin/attachments-categories*') ? 'sidebar-nav-active' : 'sidebar-nav' }}"
                                        href="#" onclick="window.openSubNav(this)">
                                        <i class="fa-fw fas c-sidebar-nav-icon fa-copy">
                                        </i>
                                        <span class="flex-grow" x-show.transition="isOpen">
                                            {{ trans('cruds.attachmentsfile.title') }}
                                        </span>
                                    </a>
                                    <ul class="ml-4 subnav hidden">
                                        @can('attachment_access')
                                            <li class="items-center">
                                                <a class="{{ request()->is('admin/attachments*') ? 'sidebar-nav-active' : 'sidebar-nav' }}"
                                                    href="{{ route('admin.attachments.index') }}">
                                                    <i class="fa-fw c-sidebar-nav-icon fas fa-file-export">
                                                    </i>
                                                    <span class="flex-grow" x-show.transition="isOpen">
                                                        {{ trans('cruds.attachment.title') }}
                                                    </span>
                                                </a>
                                            </li>
                                        @endcan
                                        @can('attachments_category_access')
                                            <li class="items-center">
                                                <a class="{{ request()->is('admin/attachments-categories*') ? 'sidebar-nav-active' : 'sidebar-nav' }}"
                                                    href="{{ route('admin.attachments-categories.index') }}">
                                                    <i class="fa-fw c-sidebar-nav-icon fas fa-file-alt">
                                                    </i>
                                                    <span class="flex-grow" x-show.transition="isOpen">
                                                        {{ trans('cruds.attachmentsCategory.title') }}
                                                    </span>
                                                </a>
                                            </li>
                                        @endcan
                                    </ul>
                                </li>
                            @endcan
                            @can('processes_manual_access')
                                <li class="items-center">
                                    <a class="has-sub {{ request()->is('admin/inputs*') || request()->is('admin/glossaries*') || request()->is('admin/outputs*') || request()->is('admin/obejctives-groups*') ? 'sidebar-nav-active' : 'sidebar-nav' }}"
                                        href="#" onclick="window.openSubNav(this)">
                                        <i class="fa-fw fas c-sidebar-nav-icon fa-book-open">
                                        </i>
                                        <span class="flex-grow" x-show.transition="isOpen">
                                            {{ trans('cruds.processesManual.title') }}
                                        </span>
                                    </a>
                                    <ul class="ml-4 subnav hidden">
                                        @can('input_access')
                                            <li class="items-center">
                                                <a class="{{ request()->is('admin/inputs*') ? 'sidebar-nav-active' : 'sidebar-nav' }}"
                                                    href="{{ route('admin.inputs.index') }}">
                                                    <i class="fa-fw c-sidebar-nav-icon fas fa-sign-in-alt">
                                                    </i>
                                                    <span class="flex-grow" x-show.transition="isOpen">
                                                        {{ trans('cruds.input.title') }}
                                                    </span>
                                                </a>
                                            </li>
                                        @endcan
                                        @can('glossary_access')
                                            <li class="items-center">
                                                <a class="{{ request()->is('admin/glossaries*') ? 'sidebar-nav-active' : 'sidebar-nav' }}"
                                                    href="{{ route('admin.glossaries.index') }}">
                                                    <i class="fa-fw c-sidebar-nav-icon fas fa-book">
                                                    </i>
                                                    <span class="flex-grow" x-show.transition="isOpen">
                                                        {{ trans('cruds.glossary.title') }}
                                                    </span>
                                                </a>
                                            </li>
                                        @endcan
                                        @can('output_access')
                                            <li class="items-center">
                                                <a class="{{ request()->is('admin/outputs*') ? 'sidebar-nav-active' : 'sidebar-nav' }}"
                                                    href="{{ route('admin.outputs.index') }}">
                                                    <i class="fa-fw c-sidebar-nav-icon fas fa-paper-plane">
                                                    </i>
                                                    <span class="flex-grow" x-show.transition="isOpen">
                                                        {{ trans('cruds.output.title') }}
                                                    </span>
                                                </a>
                                            </li>
                                        @endcan
                                        @can('obejctives_group_access')
                                            <li class="items-center">
                                                <a class="{{ request()->is('admin/obejctives-groups*') ? 'sidebar-nav-active' : 'sidebar-nav' }}"
                                                    href="{{ route('admin.obejctives-groups.index') }}">
                                                    <i class="fa-fw c-sidebar-nav-icon fas fa-users">
                                                    </i>
                                                    <span class="flex-grow" x-show.transition="isOpen">
                                                        {{ trans('cruds.obejctivesGroup.title') }}
                                                    </span>
                                                </a>
                                            </li>
                                        @endcan
                                    </ul>
                                </li>
                            @endcan
                            @can('risk_access')
                                <li class="items-center">
                                    <a class="has-sub {{ request()->is('admin/activities-risks*') || request()->is('admin/activities-risks-politics*') || request()->is('admin/activities-risks-probabilities*') || request()->is('admin/activities-risks-impacts*') || request()->is('admin/activities-risks-causes*') || request()->is('admin/activities-risks-consequences*') || request()->is('admin/risks-controls*') || request()->is('admin/risks-controls-types*') || request()->is('admin/risks-controls-frecuencies*') || request()->is('admin/risks-controls-methods*') ? 'sidebar-nav-active' : 'sidebar-nav' }}"
                                        href="#" onclick="window.openSubNav(this)">
                                        <i class="fa-fw fas c-sidebar-nav-icon fa-exclamation-triangle">
                                        </i>
                                        <span class="flex-grow" x-show.transition="isOpen">
                                            {{ trans('cruds.risk.title') }}
                                        </span>
                                    </a>
                                    <ul class="ml-4 subnav hidden">
                                        @can('activities_risk_access')
                                            <li class="items-center">
                                                <a class="{{ request()->is('admin/activities-risks*') ? 'sidebar-nav-active' : 'sidebar-nav' }}"
                                                    href="{{ route('admin.activities-risks.index') }}">
                                                    <i class="fa-fw c-sidebar-nav-icon fas fa-exclamation-triangle">
                                                    </i>
                                                    <span class="flex-grow" x-show.transition="isOpen">
                                                        {{ trans('cruds.activitiesRisk.title') }}
                                                    </span>
                                                </a>
                                            </li>
                                        @endcan
                                        @can('activities_risks_politic_access')
                                            <li class="items-center">
                                                <a class="{{ request()->is('admin/activities-risks-politics*') ? 'sidebar-nav-active' : 'sidebar-nav' }}"
                                                    href="{{ route('admin.activities-risks-politics.index') }}">
                                                    <i class="fa-fw c-sidebar-nav-icon fas fa-balance-scale">
                                                    </i>
                                                    <span class="flex-grow" x-show.transition="isOpen">
                                                        {{ trans('cruds.activitiesRisksPolitic.title') }}
                                                    </span>
                                                </a>
                                            </li>
                                        @endcan
                                        @can('activities_risks_probability_access')
                                            <li class="items-center">
                                                <a class="{{ request()->is('admin/activities-risks-probabilities*') ? 'sidebar-nav-active' : 'sidebar-nav' }}"
                                                    href="{{ route('admin.activities-risks-probabilities.index') }}">
                                                    <i class="fa-fw c-sidebar-nav-icon fas fa-chart-line">
                                                    </i>
                                                    <span class="flex-grow" x-show.transition="isOpen">
                                                        {{ trans('cruds.activitiesRisksProbability.title') }}
                                                    </span>
                                                </a>
                                            </li>
                                        @endcan
                                        @can('activities_risks_impact_access')
                                            <li class="items-center">
                                                <a class="{{ request()->is('admin/activities-risks-impacts*') ? 'sidebar-nav-active' : 'sidebar-nav' }}"
                                                    href="{{ route('admin.activities-risks-impacts.index') }}">
                                                    <i class="fa-fw c-sidebar-nav-icon fas fa-bullseye">
                                                    </i>
                                                    <span class="flex-grow" x-show.transition="isOpen">
                                                        {{ trans('cruds.activitiesRisksImpact.title') }}
                                                    </span>
                                                </a>
                                            </li>
                                        @endcan
                                        @can('activities_risks_cause_access')
                                            <li class="items-center">
                                                <a class="{{ request()->is('admin/activities-risks-causes*') ? 'sidebar-nav-active' : 'sidebar-nav' }}"
                                                    href="{{ route('admin.activities-risks-causes.index') }}">
                                                    <i class="fa-fw c-sidebar-nav-icon fas fa-wrench">
                                                    </i>
                                                    <span class="flex-grow" x-show.transition="isOpen">
                                                        {{ trans('cruds.activitiesRisksCause.title') }}
                                                    </span>
                                                </a>
                                            </li>
                                        @endcan
                                        @can('activities_risks_consequence_access')
                                            <li class="items-center">
                                                <a class="{{ request()->is('admin/activities-risks-consequences*') ? 'sidebar-nav-active' : 'sidebar-nav' }}"
                                                    href="{{ route('admin.activities-risks-consequences.index') }}">
                                                    <i class="fa-fw c-sidebar-nav-icon fas fa-exclamation-circle">
                                                    </i>
                                                    <span class="flex-grow" x-show.transition="isOpen">
                                                        {{ trans('cruds.activitiesRisksConsequence.title') }}
                                                    </span>
                                                </a>
                                            </li>
                                        @endcan
                                        @can('control_access')
                                            <li class="items-center">
                                                <a class="has-sub {{ request()->is('admin/risks-controls*') || request()->is('admin/risks-controls-types*') || request()->is('admin/risks-controls-frecuencies*') || request()->is('admin/risks-controls-methods*') ? 'sidebar-nav-active' : 'sidebar-nav' }}"
                                                    href="#" onclick="window.openSubNav(this)">
                                                    <i class="fa-fw fas c-sidebar-nav-icon fa-shield-alt">
                                                    </i>
                                                    <span class="flex-grow" x-show.transition="isOpen">
                                                        {{ trans('cruds.control.title') }}
                                                    </span>
                                                </a>
                                                <ul class="ml-4 subnav hidden">
                                                    @can('risks_control_access')
                                                        <li class="items-center">
                                                            <a class="{{ request()->is('admin/risks-controls*') ? 'sidebar-nav-active' : 'sidebar-nav' }}"
                                                                href="{{ route('admin.risks-controls.index') }}">
                                                                <i class="fa-fw c-sidebar-nav-icon fas fa-shield-alt">
                                                                </i>
                                                                <span class="flex-grow" x-show.transition="isOpen">
                                                                    {{ trans('cruds.risksControl.title') }}
                                                                </span>
                                                            </a>
                                                        </li>
                                                    @endcan
                                                    @can('risks_controls_type_access')
                                                        <li class="items-center">
                                                            <a class="{{ request()->is('admin/risks-controls-types*') ? 'sidebar-nav-active' : 'sidebar-nav' }}"
                                                                href="{{ route('admin.risks-controls-types.index') }}">
                                                                <i class="fa-fw c-sidebar-nav-icon fas fa-list">
                                                                </i>
                                                                <span class="flex-grow" x-show.transition="isOpen">
                                                                    {{ trans('cruds.risksControlsType.title') }}
                                                                </span>
                                                            </a>
                                                        </li>
                                                    @endcan
                                                    @can('risks_controls_frecuency_access')
                                                        <li class="items-center">
                                                            <a class="{{ request()->is('admin/risks-controls-frecuencies*') ? 'sidebar-nav-active' : 'sidebar-nav' }}"
                                                                href="{{ route('admin.risks-controls-frecuencies.index') }}">
                                                                <i class="fa-fw c-sidebar-nav-icon fas fa-calendar-alt">
                                                                </i>
                                                                <span class="flex-grow" x-show.transition="isOpen">
                                                                    {{ trans('cruds.risksControlsFrecuency.title') }}
                                                                </span>
                                                            </a>
                                                        </li>
                                                    @endcan
                                                    @can('risks_controls_method_access')
                                                        <li class="items-center">
                                                            <a class="{{ request()->is('admin/risks-controls-methods*') ? 'sidebar-nav-active' : 'sidebar-nav' }}"
                                                                href="{{ route('admin.risks-controls-methods.index') }}">
                                                                <i class="fa-fw c-sidebar-nav-icon fas fa-chess-board">
                                                                </i>
                                                                <span class="flex-grow" x-show.transition="isOpen">
                                                                    {{ trans('cruds.risksControlsMethod.title') }}
                                                                </span>
                                                            </a>
                                                        </li>
                                                    @endcan
                                                </ul>
                                            </li>
                                        @endcan
                                    </ul>
                                </li>
                            @endcan

                        </ul>
                    </li>

                    {{-- @can('tablas_maestra_access')
                        <li class="items-center">
                            <a class="has-sub {{ request()->is('admin/directions*') || request()->is('admin/dependencies*') ? 'sidebar-nav-active' : 'sidebar-nav' }}"
                                href="#" onclick="window.openSubNav(this)">
                                <i class="fa-fw fas c-sidebar-nav-icon fa-table">
                                </i>
                                <span class="flex-grow" x-show.transition="isOpen">
                                    {{ trans('cruds.tablasMaestra.title') }}
                                </span>
                            </a>
                            <ul class="ml-4 subnav hidden">
                                @can('direction_access')
                                    <li class="items-center">
                                        <a class="{{ request()->is('admin/directions*') ? 'sidebar-nav-active' : 'sidebar-nav' }}"
                                            href="{{ route('admin.directions.index') }}">
                                            <i class="fa-fw c-sidebar-nav-icon fas fa-briefcase">
                                            </i>
                                            <span class="flex-grow" x-show.transition="isOpen">
                                                {{ trans('cruds.direction.title') }}
                                            </span>
                                        </a>
                                    </li>
                                @endcan
                                @can('dependency_access')
                                    <li class="items-center">
                                        <a class="{{ request()->is('admin/dependencies*') ? 'sidebar-nav-active' : 'sidebar-nav' }}"
                                            href="{{ route('admin.dependencies.index') }}">
                                            <i class="fa-fw c-sidebar-nav-icon fas fa-sitemap">
                                            </i>
                                            <span class="flex-grow" x-show.transition="isOpen">
                                                {{ trans('cruds.dependency.title') }}
                                            </span>
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcan --}}

                    {{-- @can('propuesta_mejora_access')
                        <li class="items-center">
                            <a class="has-sub {{ request()->is('admin/processes-upgrade-proposals*') || request()->is('admin/upgrade-proposals-states*') ? 'sidebar-nav-active' : 'sidebar-nav' }}"
                                href="#" onclick="window.openSubNav(this)">
                                <i class="fa-fw fas c-sidebar-nav-icon fa-cogs">
                                </i>
                                <span class="flex-grow" x-show.transition="isOpen">
                                    {{ trans('cruds.propuestaMejora.title') }}
                                </span>
                            </a>
                            <ul class="ml-4 subnav hidden">
                                @can('processes_upgrade_proposal_access')
                                    <li class="items-center">
                                        <a class="{{ request()->is('admin/processes-upgrade-proposals*') ? 'sidebar-nav-active' : 'sidebar-nav' }}"
                                            href="{{ route('admin.processes-upgrade-proposals.index') }}">
                                            <i class="fa-fw c-sidebar-nav-icon fas fa-lightbulb">
                                            </i>
                                            <span class="flex-grow" x-show.transition="isOpen">
                                                {{ trans('cruds.processesUpgradeProposal.title') }}
                                            </span>
                                        </a>
                                    </li>
                                @endcan
                                @can('upgrade_proposals_state_access')
                                    <li class="items-center">
                                        <a class="{{ request()->is('admin/upgrade-proposals-states*') ? 'sidebar-nav-active' : 'sidebar-nav' }}"
                                            href="{{ route('admin.upgrade-proposals-states.index') }}">
                                            <i class="fa-fw c-sidebar-nav-icon fas fa-circle">
                                            </i>
                                            <span class="flex-grow" x-show.transition="isOpen">
                                                {{ trans('cruds.upgradeProposalsState.title') }}
                                            </span>
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcan
                    @can('attachmentsfile_access')
                        <li class="items-center">
                            <a class="has-sub {{ request()->is('admin/attachments*') || request()->is('admin/attachments-categories*') ? 'sidebar-nav-active' : 'sidebar-nav' }}"
                                href="#" onclick="window.openSubNav(this)">
                                <i class="fa-fw fas c-sidebar-nav-icon fa-copy">
                                </i>
                                <span class="flex-grow" x-show.transition="isOpen">
                                    {{ trans('cruds.attachmentsfile.title') }}
                                </span>
                            </a>
                            <ul class="ml-4 subnav hidden">
                                @can('attachment_access')
                                    <li class="items-center">
                                        <a class="{{ request()->is('admin/attachments*') ? 'sidebar-nav-active' : 'sidebar-nav' }}"
                                            href="{{ route('admin.attachments.index') }}">
                                            <i class="fa-fw c-sidebar-nav-icon fas fa-file-export">
                                            </i>
                                            <span class="flex-grow" x-show.transition="isOpen">
                                                {{ trans('cruds.attachment.title') }}
                                            </span>
                                        </a>
                                    </li>
                                @endcan
                                @can('attachments_category_access')
                                    <li class="items-center">
                                        <a class="{{ request()->is('admin/attachments-categories*') ? 'sidebar-nav-active' : 'sidebar-nav' }}"
                                            href="{{ route('admin.attachments-categories.index') }}">
                                            <i class="fa-fw c-sidebar-nav-icon fas fa-file-alt">
                                            </i>
                                            <span class="flex-grow" x-show.transition="isOpen">
                                                {{ trans('cruds.attachmentsCategory.title') }}
                                            </span>
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcan
                    @can('processes_manual_access')
                        <li class="items-center">
                            <a class="has-sub {{ request()->is('admin/inputs*') || request()->is('admin/glossaries*') || request()->is('admin/outputs*') || request()->is('admin/obejctives-groups*') ? 'sidebar-nav-active' : 'sidebar-nav' }}"
                                href="#" onclick="window.openSubNav(this)">
                                <i class="fa-fw fas c-sidebar-nav-icon fa-book-open">
                                </i>
                                <span class="flex-grow" x-show.transition="isOpen">
                                    {{ trans('cruds.processesManual.title') }}
                                </span>
                            </a>
                            <ul class="ml-4 subnav hidden">
                                @can('input_access')
                                    <li class="items-center">
                                        <a class="{{ request()->is('admin/inputs*') ? 'sidebar-nav-active' : 'sidebar-nav' }}"
                                            href="{{ route('admin.inputs.index') }}">
                                            <i class="fa-fw c-sidebar-nav-icon fas fa-sign-in-alt">
                                            </i>
                                            <span class="flex-grow" x-show.transition="isOpen">
                                                {{ trans('cruds.input.title') }}
                                            </span>
                                        </a>
                                    </li>
                                @endcan
                                @can('glossary_access')
                                    <li class="items-center">
                                        <a class="{{ request()->is('admin/glossaries*') ? 'sidebar-nav-active' : 'sidebar-nav' }}"
                                            href="{{ route('admin.glossaries.index') }}">
                                            <i class="fa-fw c-sidebar-nav-icon fas fa-book">
                                            </i>
                                            <span class="flex-grow" x-show.transition="isOpen">
                                                {{ trans('cruds.glossary.title') }}
                                            </span>
                                        </a>
                                    </li>
                                @endcan
                                @can('output_access')
                                    <li class="items-center">
                                        <a class="{{ request()->is('admin/outputs*') ? 'sidebar-nav-active' : 'sidebar-nav' }}"
                                            href="{{ route('admin.outputs.index') }}">
                                            <i class="fa-fw c-sidebar-nav-icon fas fa-paper-plane">
                                            </i>
                                            <span class="flex-grow" x-show.transition="isOpen">
                                                {{ trans('cruds.output.title') }}
                                            </span>
                                        </a>
                                    </li>
                                @endcan
                                @can('obejctives_group_access')
                                    <li class="items-center">
                                        <a class="{{ request()->is('admin/obejctives-groups*') ? 'sidebar-nav-active' : 'sidebar-nav' }}"
                                            href="{{ route('admin.obejctives-groups.index') }}">
                                            <i class="fa-fw c-sidebar-nav-icon fas fa-users">
                                            </i>
                                            <span class="flex-grow" x-show.transition="isOpen">
                                                {{ trans('cruds.obejctivesGroup.title') }}
                                            </span>
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcan
                    @can('risk_access')
                        <li class="items-center">
                            <a class="has-sub {{ request()->is('admin/activities-risks*') || request()->is('admin/activities-risks-politics*') || request()->is('admin/activities-risks-probabilities*') || request()->is('admin/activities-risks-impacts*') || request()->is('admin/activities-risks-causes*') || request()->is('admin/activities-risks-consequences*') || request()->is('admin/risks-controls*') || request()->is('admin/risks-controls-types*') || request()->is('admin/risks-controls-frecuencies*') || request()->is('admin/risks-controls-methods*') ? 'sidebar-nav-active' : 'sidebar-nav' }}"
                                href="#" onclick="window.openSubNav(this)">
                                <i class="fa-fw fas c-sidebar-nav-icon fa-exclamation-triangle">
                                </i>
                                <span class="flex-grow" x-show.transition="isOpen">
                                    {{ trans('cruds.risk.title') }}
                                </span>
                            </a>
                            <ul class="ml-4 subnav hidden">
                                @can('activities_risk_access')
                                    <li class="items-center">
                                        <a class="{{ request()->is('admin/activities-risks*') ? 'sidebar-nav-active' : 'sidebar-nav' }}"
                                            href="{{ route('admin.activities-risks.index') }}">
                                            <i class="fa-fw c-sidebar-nav-icon fas fa-exclamation-triangle">
                                            </i>
                                            <span class="flex-grow" x-show.transition="isOpen">
                                                {{ trans('cruds.activitiesRisk.title') }}
                                            </span>
                                        </a>
                                    </li>
                                @endcan
                                @can('activities_risks_politic_access')
                                    <li class="items-center">
                                        <a class="{{ request()->is('admin/activities-risks-politics*') ? 'sidebar-nav-active' : 'sidebar-nav' }}"
                                            href="{{ route('admin.activities-risks-politics.index') }}">
                                            <i class="fa-fw c-sidebar-nav-icon fas fa-balance-scale">
                                            </i>
                                            <span class="flex-grow" x-show.transition="isOpen">
                                                {{ trans('cruds.activitiesRisksPolitic.title') }}
                                            </span>
                                        </a>
                                    </li>
                                @endcan
                                @can('activities_risks_probability_access')
                                    <li class="items-center">
                                        <a class="{{ request()->is('admin/activities-risks-probabilities*') ? 'sidebar-nav-active' : 'sidebar-nav' }}"
                                            href="{{ route('admin.activities-risks-probabilities.index') }}">
                                            <i class="fa-fw c-sidebar-nav-icon fas fa-chart-line">
                                            </i>
                                            <span class="flex-grow" x-show.transition="isOpen">
                                                {{ trans('cruds.activitiesRisksProbability.title') }}
                                            </span>
                                        </a>
                                    </li>
                                @endcan
                                @can('activities_risks_impact_access')
                                    <li class="items-center">
                                        <a class="{{ request()->is('admin/activities-risks-impacts*') ? 'sidebar-nav-active' : 'sidebar-nav' }}"
                                            href="{{ route('admin.activities-risks-impacts.index') }}">
                                            <i class="fa-fw c-sidebar-nav-icon fas fa-bullseye">
                                            </i>
                                            <span class="flex-grow" x-show.transition="isOpen">
                                                {{ trans('cruds.activitiesRisksImpact.title') }}
                                            </span>
                                        </a>
                                    </li>
                                @endcan
                                @can('activities_risks_cause_access')
                                    <li class="items-center">
                                        <a class="{{ request()->is('admin/activities-risks-causes*') ? 'sidebar-nav-active' : 'sidebar-nav' }}"
                                            href="{{ route('admin.activities-risks-causes.index') }}">
                                            <i class="fa-fw c-sidebar-nav-icon fas fa-wrench">
                                            </i>
                                            <span class="flex-grow" x-show.transition="isOpen">
                                                {{ trans('cruds.activitiesRisksCause.title') }}
                                            </span>
                                        </a>
                                    </li>
                                @endcan
                                @can('activities_risks_consequence_access')
                                    <li class="items-center">
                                        <a class="{{ request()->is('admin/activities-risks-consequences*') ? 'sidebar-nav-active' : 'sidebar-nav' }}"
                                            href="{{ route('admin.activities-risks-consequences.index') }}">
                                            <i class="fa-fw c-sidebar-nav-icon fas fa-exclamation-circle">
                                            </i>
                                            <span class="flex-grow" x-show.transition="isOpen">
                                                {{ trans('cruds.activitiesRisksConsequence.title') }}
                                            </span>
                                        </a>
                                    </li>
                                @endcan
                                @can('control_access')
                                    <li class="items-center">
                                        <a class="has-sub {{ request()->is('admin/risks-controls*') || request()->is('admin/risks-controls-types*') || request()->is('admin/risks-controls-frecuencies*') || request()->is('admin/risks-controls-methods*') ? 'sidebar-nav-active' : 'sidebar-nav' }}"
                                            href="#" onclick="window.openSubNav(this)">
                                            <i class="fa-fw fas c-sidebar-nav-icon fa-shield-alt">
                                            </i>
                                            <span class="flex-grow" x-show.transition="isOpen">
                                                {{ trans('cruds.control.title') }}
                                            </span>
                                        </a>
                                        <ul class="ml-4 subnav hidden">
                                            @can('risks_control_access')
                                                <li class="items-center">
                                                    <a class="{{ request()->is('admin/risks-controls*') ? 'sidebar-nav-active' : 'sidebar-nav' }}"
                                                        href="{{ route('admin.risks-controls.index') }}">
                                                        <i class="fa-fw c-sidebar-nav-icon fas fa-shield-alt">
                                                        </i>
                                                        <span class="flex-grow" x-show.transition="isOpen">
                                                            {{ trans('cruds.risksControl.title') }}
                                                        </span>
                                                    </a>
                                                </li>
                                            @endcan
                                            @can('risks_controls_type_access')
                                                <li class="items-center">
                                                    <a class="{{ request()->is('admin/risks-controls-types*') ? 'sidebar-nav-active' : 'sidebar-nav' }}"
                                                        href="{{ route('admin.risks-controls-types.index') }}">
                                                        <i class="fa-fw c-sidebar-nav-icon fas fa-list">
                                                        </i>
                                                        <span class="flex-grow" x-show.transition="isOpen">
                                                            {{ trans('cruds.risksControlsType.title') }}
                                                        </span>
                                                    </a>
                                                </li>
                                            @endcan
                                            @can('risks_controls_frecuency_access')
                                                <li class="items-center">
                                                    <a class="{{ request()->is('admin/risks-controls-frecuencies*') ? 'sidebar-nav-active' : 'sidebar-nav' }}"
                                                        href="{{ route('admin.risks-controls-frecuencies.index') }}">
                                                        <i class="fa-fw c-sidebar-nav-icon fas fa-calendar-alt">
                                                        </i>
                                                        <span class="flex-grow" x-show.transition="isOpen">
                                                            {{ trans('cruds.risksControlsFrecuency.title') }}
                                                        </span>
                                                    </a>
                                                </li>
                                            @endcan
                                            @can('risks_controls_method_access')
                                                <li class="items-center">
                                                    <a class="{{ request()->is('admin/risks-controls-methods*') ? 'sidebar-nav-active' : 'sidebar-nav' }}"
                                                        href="{{ route('admin.risks-controls-methods.index') }}">
                                                        <i class="fa-fw c-sidebar-nav-icon fas fa-chess-board">
                                                        </i>
                                                        <span class="flex-grow" x-show.transition="isOpen">
                                                            {{ trans('cruds.risksControlsMethod.title') }}
                                                        </span>
                                                    </a>
                                                </li>
                                            @endcan
                                        </ul>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcan --}}


                    @if (file_exists(app_path('Http/Controllers/Auth/UserProfileController.php')))
                        @can('auth_profile_edit')
                            <li class="items-center">
                                <a href="{{ route('profile.show') }}"
                                    class="{{ request()->is('profile') ? 'sidebar-nav-active' : 'sidebar-nav' }}">
                                    <i class="fa-fw c-sidebar-nav-icon fas fa-user-circle"></i>
                                    <span class="flex-grow" x-show.transition="isOpen">
                                        {{ trans('global.my_profile') }}
                                    </span>
                                </a>
                            </li>
                        @endcan
                    @endif

                    <li class="items-center">
                        <a href="#"
                            onclick="event.preventDefault(); document.getElementById('logoutform').submit();"
                            class="sidebar-nav">
                            <i class="fa-fw fas fa-sign-out-alt"></i>
                            <span class="flex-grow" x-show.transition="isOpen">
                                {{ trans('global.logout') }}
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        </nav>
</div>
