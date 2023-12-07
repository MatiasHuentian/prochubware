<nav class="md:left-0 md:block md:fixed md:top-0 md:bottom-0 md:overflow-y-auto md:flex-row md:flex-nowrap md:overflow-hidden shadow-xl bg-white flex flex-wrap items-center justify-between relative md:w-64 z-10 py-4 px-6">
    <div class="md:flex-col md:items-stretch md:min-h-full md:flex-nowrap px-0 flex flex-wrap items-center justify-between w-full mx-auto">
        <button class="cursor-pointer text-black opacity-50 md:hidden px-3 py-1 text-xl leading-none bg-transparent rounded border border-solid border-transparent" type="button" onclick="toggleNavbar('example-collapse-sidebar')">
            <i class="fas fa-bars"></i>
        </button>
        <a class="md:block text-left md:pb-2 text-blueGray-700 mr-0 inline-block whitespace-nowrap text-sm uppercase font-bold p-4 px-0" href="{{ route('admin.home') }}">
            {{ trans('panel.site_title') }}
        </a>
        <div class="md:flex md:flex-col md:items-stretch md:opacity-100 md:relative md:mt-4 md:shadow-none shadow absolute top-0 left-0 right-0 z-40 overflow-y-auto overflow-x-hidden h-auto items-center flex-1 rounded hidden" id="example-collapse-sidebar">
            <div class="md:min-w-full md:hidden block pb-4 mb-4 border-b border-solid border-blueGray-300">
                <div class="flex flex-wrap">
                    <div class="w-6/12">
                        <a class="md:block text-left md:pb-2 text-blueGray-700 mr-0 inline-block whitespace-nowrap text-sm uppercase font-bold p-4 px-0" href="{{ route('admin.home') }}">
                            {{ trans('panel.site_title') }}
                        </a>
                    </div>
                    <div class="w-6/12 flex justify-end">
                        <button type="button" class="cursor-pointer text-black opacity-50 md:hidden px-3 py-1 text-xl leading-none bg-transparent rounded border border-solid border-transparent" onclick="toggleNavbar('example-collapse-sidebar')">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>
            <form class="mt-6 mb-4 md:hidden">
                <div class="mb-3 pt-0">
                    @livewire('global-searcher')
                </div>
            </form>

            <!-- Divider -->
            <div class="flex md:hidden">
                @if(file_exists(app_path('Http/Livewire/LanguageSwitcher.php')))
                    <livewire:language-switcher />
                @endif
            </div>
            <hr class="mb-6 md:min-w-full" />
            <!-- Heading -->

            <ul class="md:flex-col md:min-w-full flex flex-col list-none">
                <li class="items-center">
                    <a href="{{ route("admin.home") }}" class="{{ request()->is("admin") ? "sidebar-nav-active" : "sidebar-nav" }}">
                        <i class="fas fa-tv"></i>
                        {{ trans('global.dashboard') }}
                    </a>
                </li>

                @can('user_management_access')
                    <li class="items-center">
                        <a class="has-sub {{ request()->is("admin/permissions*")||request()->is("admin/roles*")||request()->is("admin/users*")||request()->is("admin/audit-logs*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="#" onclick="window.openSubNav(this)">
                            <i class="fa-fw fas c-sidebar-nav-icon fa-users">
                            </i>
                            {{ trans('cruds.userManagement.title') }}
                        </a>
                        <ul class="ml-4 subnav hidden">
                            @can('permission_access')
                                <li class="items-center">
                                    <a class="{{ request()->is("admin/permissions*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.permissions.index") }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-unlock-alt">
                                        </i>
                                        {{ trans('cruds.permission.title') }}
                                    </a>
                                </li>
                            @endcan
                            @can('role_access')
                                <li class="items-center">
                                    <a class="{{ request()->is("admin/roles*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.roles.index") }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-briefcase">
                                        </i>
                                        {{ trans('cruds.role.title') }}
                                    </a>
                                </li>
                            @endcan
                            @can('user_access')
                                <li class="items-center">
                                    <a class="{{ request()->is("admin/users*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.users.index") }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-user">
                                        </i>
                                        {{ trans('cruds.user.title') }}
                                    </a>
                                </li>
                            @endcan
                            @can('audit_log_access')
                                <li class="items-center">
                                    <a class="{{ request()->is("admin/audit-logs*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.audit-logs.index") }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-file-alt">
                                        </i>
                                        {{ trans('cruds.auditLog.title') }}
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('tablas_maestra_access')
                    <li class="items-center">
                        <a class="has-sub {{ request()->is("admin/directions*")||request()->is("admin/dependencies*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="#" onclick="window.openSubNav(this)">
                            <i class="fa-fw fas c-sidebar-nav-icon fa-table">
                            </i>
                            {{ trans('cruds.tablasMaestra.title') }}
                        </a>
                        <ul class="ml-4 subnav hidden">
                            @can('direction_access')
                                <li class="items-center">
                                    <a class="{{ request()->is("admin/directions*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.directions.index") }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-briefcase">
                                        </i>
                                        {{ trans('cruds.direction.title') }}
                                    </a>
                                </li>
                            @endcan
                            @can('dependency_access')
                                <li class="items-center">
                                    <a class="{{ request()->is("admin/dependencies*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.dependencies.index") }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-sitemap">
                                        </i>
                                        {{ trans('cruds.dependency.title') }}
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('propuesta_mejora_access')
                    <li class="items-center">
                        <a class="has-sub {{ request()->is("admin/processes-upgrade-proposals*")||request()->is("admin/upgrade-proposals-states*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="#" onclick="window.openSubNav(this)">
                            <i class="fa-fw fas c-sidebar-nav-icon fa-cogs">
                            </i>
                            {{ trans('cruds.propuestaMejora.title') }}
                        </a>
                        <ul class="ml-4 subnav hidden">
                            @can('processes_upgrade_proposal_access')
                                <li class="items-center">
                                    <a class="{{ request()->is("admin/processes-upgrade-proposals*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.processes-upgrade-proposals.index") }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-lightbulb">
                                        </i>
                                        {{ trans('cruds.processesUpgradeProposal.title') }}
                                    </a>
                                </li>
                            @endcan
                            @can('upgrade_proposals_state_access')
                                <li class="items-center">
                                    <a class="{{ request()->is("admin/upgrade-proposals-states*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.upgrade-proposals-states.index") }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-circle">
                                        </i>
                                        {{ trans('cruds.upgradeProposalsState.title') }}
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('attachmentsfile_access')
                    <li class="items-center">
                        <a class="has-sub {{ request()->is("admin/attachments*")||request()->is("admin/attachments-categories*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="#" onclick="window.openSubNav(this)">
                            <i class="fa-fw fas c-sidebar-nav-icon fa-copy">
                            </i>
                            {{ trans('cruds.attachmentsfile.title') }}
                        </a>
                        <ul class="ml-4 subnav hidden">
                            @can('attachment_access')
                                <li class="items-center">
                                    <a class="{{ request()->is("admin/attachments*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.attachments.index") }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-file-export">
                                        </i>
                                        {{ trans('cruds.attachment.title') }}
                                    </a>
                                </li>
                            @endcan
                            @can('attachments_category_access')
                                <li class="items-center">
                                    <a class="{{ request()->is("admin/attachments-categories*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.attachments-categories.index") }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-file-alt">
                                        </i>
                                        {{ trans('cruds.attachmentsCategory.title') }}
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('processes_manual_access')
                    <li class="items-center">
                        <a class="has-sub {{ request()->is("admin/inputs*")||request()->is("admin/glossaries*")||request()->is("admin/outputs*")||request()->is("admin/obejctives-groups*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="#" onclick="window.openSubNav(this)">
                            <i class="fa-fw fas c-sidebar-nav-icon fa-book-open">
                            </i>
                            {{ trans('cruds.processesManual.title') }}
                        </a>
                        <ul class="ml-4 subnav hidden">
                            @can('input_access')
                                <li class="items-center">
                                    <a class="{{ request()->is("admin/inputs*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.inputs.index") }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-sign-in-alt">
                                        </i>
                                        {{ trans('cruds.input.title') }}
                                    </a>
                                </li>
                            @endcan
                            @can('glossary_access')
                                <li class="items-center">
                                    <a class="{{ request()->is("admin/glossaries*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.glossaries.index") }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-book">
                                        </i>
                                        {{ trans('cruds.glossary.title') }}
                                    </a>
                                </li>
                            @endcan
                            @can('output_access')
                                <li class="items-center">
                                    <a class="{{ request()->is("admin/outputs*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.outputs.index") }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-paper-plane">
                                        </i>
                                        {{ trans('cruds.output.title') }}
                                    </a>
                                </li>
                            @endcan
                            @can('obejctives_group_access')
                                <li class="items-center">
                                    <a class="{{ request()->is("admin/obejctives-groups*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.obejctives-groups.index") }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-users">
                                        </i>
                                        {{ trans('cruds.obejctivesGroup.title') }}
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('process_menu_access')
                    <li class="items-center">
                        <a class="has-sub {{ request()->is("admin/processes*")||request()->is("admin/processes-activities*")||request()->is("admin/processes-states*")||request()->is("admin/processes-kpis*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="#" onclick="window.openSubNav(this)">
                            <i class="fa-fw fas c-sidebar-nav-icon fa-cogs">
                            </i>
                            {{ trans('cruds.processMenu.title') }}
                        </a>
                        <ul class="ml-4 subnav hidden">
                            @can('process_access')
                                <li class="items-center">
                                    <a class="{{ request()->is("admin/processes*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.processes.index") }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-cogs">
                                        </i>
                                        {{ trans('cruds.process.title') }}
                                    </a>
                                </li>
                            @endcan
                            @can('processes_activity_access')
                                <li class="items-center">
                                    <a class="{{ request()->is("admin/processes-activities*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.processes-activities.index") }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-tasks">
                                        </i>
                                        {{ trans('cruds.processesActivity.title') }}
                                    </a>
                                </li>
                            @endcan
                            @can('processes_state_access')
                                <li class="items-center">
                                    <a class="{{ request()->is("admin/processes-states*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.processes-states.index") }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-circle">
                                        </i>
                                        {{ trans('cruds.processesState.title') }}
                                    </a>
                                </li>
                            @endcan
                            @can('processes_kpi_access')
                                <li class="items-center">
                                    <a class="{{ request()->is("admin/processes-kpis*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.processes-kpis.index") }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-chart-bar">
                                        </i>
                                        {{ trans('cruds.processesKpi.title') }}
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('risk_access')
                    <li class="items-center">
                        <a class="has-sub {{ request()->is("admin/activities-risks*")||request()->is("admin/activities-risks-politics*")||request()->is("admin/activities-risks-probabilities*")||request()->is("admin/activities-risks-impacts*")||request()->is("admin/activities-risks-causes*")||request()->is("admin/activities-risks-consequences*")||request()->is("admin/risks-controls*")||request()->is("admin/risks-controls-types*")||request()->is("admin/risks-controls-frecuencies*")||request()->is("admin/risks-controls-methods*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="#" onclick="window.openSubNav(this)">
                            <i class="fa-fw fas c-sidebar-nav-icon fa-exclamation-triangle">
                            </i>
                            {{ trans('cruds.risk.title') }}
                        </a>
                        <ul class="ml-4 subnav hidden">
                            @can('activities_risk_access')
                                <li class="items-center">
                                    <a class="{{ request()->is("admin/activities-risks*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.activities-risks.index") }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-exclamation-triangle">
                                        </i>
                                        {{ trans('cruds.activitiesRisk.title') }}
                                    </a>
                                </li>
                            @endcan
                            @can('activities_risks_politic_access')
                                <li class="items-center">
                                    <a class="{{ request()->is("admin/activities-risks-politics*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.activities-risks-politics.index") }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-balance-scale">
                                        </i>
                                        {{ trans('cruds.activitiesRisksPolitic.title') }}
                                    </a>
                                </li>
                            @endcan
                            @can('activities_risks_probability_access')
                                <li class="items-center">
                                    <a class="{{ request()->is("admin/activities-risks-probabilities*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.activities-risks-probabilities.index") }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-chart-line">
                                        </i>
                                        {{ trans('cruds.activitiesRisksProbability.title') }}
                                    </a>
                                </li>
                            @endcan
                            @can('activities_risks_impact_access')
                                <li class="items-center">
                                    <a class="{{ request()->is("admin/activities-risks-impacts*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.activities-risks-impacts.index") }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-bullseye">
                                        </i>
                                        {{ trans('cruds.activitiesRisksImpact.title') }}
                                    </a>
                                </li>
                            @endcan
                            @can('activities_risks_cause_access')
                                <li class="items-center">
                                    <a class="{{ request()->is("admin/activities-risks-causes*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.activities-risks-causes.index") }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-wrench">
                                        </i>
                                        {{ trans('cruds.activitiesRisksCause.title') }}
                                    </a>
                                </li>
                            @endcan
                            @can('activities_risks_consequence_access')
                                <li class="items-center">
                                    <a class="{{ request()->is("admin/activities-risks-consequences*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.activities-risks-consequences.index") }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-exclamation-circle">
                                        </i>
                                        {{ trans('cruds.activitiesRisksConsequence.title') }}
                                    </a>
                                </li>
                            @endcan
                            @can('control_access')
                                <li class="items-center">
                                    <a class="has-sub {{ request()->is("admin/risks-controls*")||request()->is("admin/risks-controls-types*")||request()->is("admin/risks-controls-frecuencies*")||request()->is("admin/risks-controls-methods*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="#" onclick="window.openSubNav(this)">
                                        <i class="fa-fw fas c-sidebar-nav-icon fa-shield-alt">
                                        </i>
                                        {{ trans('cruds.control.title') }}
                                    </a>
                                    <ul class="ml-4 subnav hidden">
                                        @can('risks_control_access')
                                            <li class="items-center">
                                                <a class="{{ request()->is("admin/risks-controls*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.risks-controls.index") }}">
                                                    <i class="fa-fw c-sidebar-nav-icon fas fa-shield-alt">
                                                    </i>
                                                    {{ trans('cruds.risksControl.title') }}
                                                </a>
                                            </li>
                                        @endcan
                                        @can('risks_controls_type_access')
                                            <li class="items-center">
                                                <a class="{{ request()->is("admin/risks-controls-types*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.risks-controls-types.index") }}">
                                                    <i class="fa-fw c-sidebar-nav-icon fas fa-list">
                                                    </i>
                                                    {{ trans('cruds.risksControlsType.title') }}
                                                </a>
                                            </li>
                                        @endcan
                                        @can('risks_controls_frecuency_access')
                                            <li class="items-center">
                                                <a class="{{ request()->is("admin/risks-controls-frecuencies*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.risks-controls-frecuencies.index") }}">
                                                    <i class="fa-fw c-sidebar-nav-icon fas fa-calendar-alt">
                                                    </i>
                                                    {{ trans('cruds.risksControlsFrecuency.title') }}
                                                </a>
                                            </li>
                                        @endcan
                                        @can('risks_controls_method_access')
                                            <li class="items-center">
                                                <a class="{{ request()->is("admin/risks-controls-methods*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.risks-controls-methods.index") }}">
                                                    <i class="fa-fw c-sidebar-nav-icon fas fa-chess-board">
                                                    </i>
                                                    {{ trans('cruds.risksControlsMethod.title') }}
                                                </a>
                                            </li>
                                        @endcan
                                    </ul>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                @if(file_exists(app_path('Http/Controllers/Auth/UserProfileController.php')))
                    @can('auth_profile_edit')
                        <li class="items-center">
                            <a href="{{ route("profile.show") }}" class="{{ request()->is("profile") ? "sidebar-nav-active" : "sidebar-nav" }}">
                                <i class="fa-fw c-sidebar-nav-icon fas fa-user-circle"></i>
                                {{ trans('global.my_profile') }}
                            </a>
                        </li>
                    @endcan
                @endif

                <li class="items-center">
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logoutform').submit();" class="sidebar-nav">
                        <i class="fa-fw fas fa-sign-out-alt"></i>
                        {{ trans('global.logout') }}
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
