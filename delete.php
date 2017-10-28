<?php include "header.php" ?>
    <div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor-desktop m-grid--desktop m-body">
        <div class="m-grid__item m-grid__item--fluid  m-grid m-grid--ver	m-container m-container--responsive m-container--xxl m-page__container">
            <div class="m-grid__item m-grid__item--fluid m-wrapper">
                <!-- BEGIN: Subheader -->
                <div class="m-subheader ">
                    <div class="d-flex align-items-center">
                        <div class="mr-auto">
                            <h3 class="m-subheader__title m-subheader__title--separator" id="main_title">
                                Database
                            </h3>
                            <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                                <li class="m-nav__item m-nav__item--home">
                                    <a href="#" class="m-nav__link m-nav__link--icon">
                                        <i class="m-nav__link-icon la la-home"></i>
                                    </a>
                                </li>
                                <li class="m-nav__separator">
                                    -
                                </li>
                                <li class="m-nav__item">
                                    <a href="javascript:;" class="m-nav__link">
												<span class="m-nav__link-text" id="sub_title">
													[Database] Credentialas
												</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- END: Subheader -->
                <div class="m-content">

                    <div id="bar-basic" class="processss_running"
                         style="clear: both;margin-bottom: 1.5%; display: none;">

                    </div>

                    <div id="progress-basic" class="process_running"
                         style="clear: both;margin-bottom: 1.5%; display: none;">

                    </div>

                    <div class="col-xl-12 process_running" id="audit_log" style="padding: 0; display: none;">
                        <!--begin:: Widgets/Audit Log-->
                        <div class="m-portlet m-portlet--full-height">
                            <div class="m-portlet__head">
                                <div class="m-portlet__head-caption">
                                    <div class="m-portlet__head-title">
                                        <h3 class="m-portlet__head-text">
                                            Audit Log
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            <div class="m-portlet__body">
                                <div class="m-scrollable" data-scrollable="true" data-max-height="400"
                                     style="height: 400px; overflow: hidden;">
                                    <div class="m-list-timeline m-list-timeline--skin-light">
                                        <div class="m-list-timeline__items">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end:: Widgets/Audit Log-->
                    </div>

                    <div id="exampleValidator" class="wizard">

                        <ul class="wizard-steps nav nav-tabs" role="tablist">
                            <li class="active nav-item" role="tab">
                                <a class="nav-link" href="javascript:;" current_ind="1">Step 1<br/>
                                    <small>Fill the credentials of database</small>
                                </a>
                            </li>
                            <li class="nav-item" role="tab">
                                <a class="nav-link" href="javascript:;" current_ind="2">Step 2<br/>
                                    <small>Let me know the table to be deleted</small>
                                </a>
                            </li>
                            <li class="nav-item" role="tab">
                                <a class="nav-link" href="javascript:;" current_ind="3">Step 3<br/>
                                    <small>Let's set the iterations</small>
                                </a>
                            </li>
                        </ul>

                        <form id="validation" class="form-horizontal">
                            <div class="wizard-content">
                                <div class="wizard-pane active" role="tabpanel">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="portlet-body form">
                                                <!-- BEGIN FORM-->
                                                <div action="#" class="horizontal-form">
                                                    <div class="form-body">
                                                        <!--row-->
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label class="control-label">Database Type</label>
                                                                    <select name="dbtype1" id="db1_dbtype"
                                                                            class="form-control">
                                                                        <option value="">Select DB Type</option>
                                                                        <option value="mysql">MySQL</option>
                                                                        <option value="pgsql">Postgres</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-4">
                                                                <div class="form-group has-error">
                                                                    <label class="control-label">Host Name</label>
                                                                    <input class="form-control" type="text" name="host"
                                                                           id="db_host" title="Host Name"
                                                                           placeholder="Host name.." value="">
                                                                </div>
                                                            </div>

                                                            <div class="col-md-4">
                                                                <div class="form-group has-error">
                                                                    <label class="control-label">Port</label>
                                                                    <input type="text" name="port" id="db_port"
                                                                           class="form-control"
                                                                           title="Port Number" placeholder="Port.."
                                                                           value="">
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <!--/row-->
                                                        <!--row-->
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label class="control-label">Database Name</label>
                                                                    <input type="text" name="database"
                                                                           class="form-control"
                                                                           id="db_database" title="Database Name"
                                                                           placeholder="Database Name.." value="">
                                                                </div>
                                                            </div>

                                                            <div class="col-md-4">
                                                                <div class="form-group has-error">
                                                                    <label class="control-label">DB Username</label>
                                                                    <input type="text" name="username"
                                                                           class="form-control"
                                                                           id="db_username" title="DB Username"
                                                                           placeholder="Userame.." value="">
                                                                </div>
                                                            </div>

                                                            <div class="col-md-4">
                                                                <div class="form-group has-error">
                                                                    <label class="control-label">DB Password</label>
                                                                    <input type="password" name="password"
                                                                           class="form-control"
                                                                           id="db_password" title="DB Password"
                                                                           placeholder="Password.." value="">
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <!--/row-->

                                                    </div>
                                                </div>
                                                <!-- END FORM-->
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="wizard-pane" role="tabpanel">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="portlet-body form">
                                                <!-- BEGIN FORM-->
                                                <div action="#" class="horizontal-form">
                                                    <div class="form-body">
                                                        <!--row-->
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label class="control-label">Table name</label>
                                                                    <input type="text" name="table" id="table"
                                                                           class="form-control"
                                                                           title="Table Name" placeholder="Table name.."
                                                                           value="">
                                                                </div>
                                                            </div>

                                                            <div class="col-md-4">
                                                                <div class="form-group has-error">
                                                                    <label class="control-label">Primary column</label>
                                                                    <input type="text" name="column" id="column"
                                                                           class="form-control"
                                                                           title="Primary column"
                                                                           placeholder="Column name.." value="">
                                                                </div>
                                                            </div>

                                                            <div class="col-md-4">
                                                                <div class="form-group has-error">
                                                                    <label class="control-label">Insert Count</label>
                                                                    <input type="text" name="count" id="count"
                                                                           class="form-control"
                                                                           title="Insert Row Count"
                                                                           placeholder="Insert Count.." value="">
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <!--/row-->
                                                        <!--row-->
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label class="control-label">Insert Order</label>
                                                                    <input type="text" name="order" id="order"
                                                                           class="form-control"
                                                                           title="Insert Order"
                                                                           placeholder="Insert Order.." value="">
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <!--/row-->

                                                    </div>
                                                </div>
                                                <!-- END FORM-->
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="wizard-pane" role="tabpanel">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="portlet-body form">
                                                <!-- BEGIN FORM-->
                                                <div action="#" class="horizontal-form">
                                                    <div class="form-body">
                                                        <!--row-->
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group has-error">
                                                                    <label class="control-label">Number of
                                                                        Iterations</label>
                                                                    <input type="text" name="iterations" id="iterations"
                                                                           class="form-control"
                                                                           title="Number of Iterations"
                                                                           placeholder="Number of Iterations.."
                                                                           value="">
                                                                </div>
                                                            </div>

                                                            <div class="col-md-4">
                                                                <div class="form-group has-error">
                                                                    <label class="control-label">Interval in
                                                                        Seconds</label>
                                                                    <input type="text" name="interval" id="interval"
                                                                           class="form-control"
                                                                           title="Interval in Seconds"
                                                                           placeholder="Interval in seconds.." value="">
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <!--/row-->

                                                    </div>
                                                </div>
                                                <!-- END FORM-->
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>

            </div>

        </div>
    </div>
<?php include "footer.php" ?>