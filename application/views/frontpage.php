<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header" data-toggle="dropdown">
        <h1>Staking <small>Dashboard</small></h1>
        <ol class="breadcrumb">
            <li><button class="btn btn-default btn-xs view-raw-stats"><i class="fa fa-list"></i> raw stats</button></li>
            <li><a href="<?php echo site_url("app/settings") ?>"><i class="fa fa-gear"></i> Settings</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row" id="box-widgets">

            <section class="col-md-12 section-raw-stats">
                <div class="alert alert-info alert-dismissable">
                    <i class="fa fa-list"></i>
                    <button type="button" class="close close-stats" aria-hidden="true">×</button>
                    <p style="margin:20px 0;">The raw JSON parsed to display the dashboard is also available <a href="<?php echo site_url("app/stats") ?>" target="_blank">here</a>.</p>
                    <span></span>
                </div>
            </section>

            <?php if (isset($message)) : ?>
                <section class="col-md-12 pop-message">
                    <div class="alert alert-<?php echo $message_type ?> alert-dismissable">
                        <i class="fa fa-check"></i>
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <?php echo $message ?>.
                    </div>
                </section>
            <?php endif; ?>
            <?php if ($this->session->flashdata('message')) : ?>
                <section class="col-md-12 pop-message">
                    <div class="alert alert-warning alert-dismissable">
                        <i class="fa fa-check"></i>
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <?php echo $this->session->flashdata('message'); ?>.
                    </div>
                </section>
            <?php endif; ?>

            <!-- Warning section -->
            <section class="col-md-12 connectedSortable ui-sortable warning-section">

                <!-- Miner error -->
                <div class="box box-solid bg-red">
                    <div class="box-header" style="cursor: move;">
                        <!-- tools box -->
                        <div class="pull-right box-tools">
                            <button class="btn btn-default btn-xs" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse"><i class="fa fa-minus"></i></button>
                        </div><!-- /. tools -->
                        <i class="fa fa-warning"></i>

                        <h3 class="box-title">Warning!</h3>
                    </div>
                    <div class="box-body warning-message"></div>
                    <div class="box-footer text-center">
                        <a href="<?php site_url("app/dashboard") ?>"><h6>Click here to refresh</h6></a>
                    </div>
                </div><!-- /.miner box -->

            </section>

            <!-- widgets section -->
            <section class="col-md-12 widgets-section">
                <div class="row disable-if-not-running">
                    <!-- total hashrate widget -->
                    <div class="col-lg-4 col-sm-4 col-xs-12">
                        <!-- small box -->
                        <div class="small-box bg-red">
                            <div class="inner">
                                <h3 class="widget-total-weight"><i class="ion spin ion-load-c"></i></h3>
                                <p>Network weight</p>
                            </div>
                            <div class="icon"><i class="ion ion-ios-speedometer-outline"></i></div>
                            <a href="#weight-history" class="small-box-footer">History <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <!-- hw/re widget -->
                    <div class="col-lg-4 col-sm-4 col-xs-12">
                        <!-- small box -->
                        <div class="small-box bg-light">
                            <div class="inner">
                                <h3 class="widget-hwre-rates"><i class="ion spin ion-load-c"></i></h3>
                                <p>Rejected rates</p>
                            </div>
                            <div class="icon"><i class="ion ion-alert-circled"></i></div>
                            <a href="#error-history" class="small-box-footer">Details <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <!-- last transaction widget -->
                    <div class="col-lg-4 col-sm-4 col-xs-12">
                        <!-- small box -->
                        <div class="small-box bg-light-blue">
                            <div class="inner">
                                <h3 class="widget-last-share"><i class="ion spin ion-load-c"></i></h3>
                                <p>Last staking transaction</p>
                            </div>
                            <div class="icon"><i class="ion ion-ios-stopwatch-outline"></i></div>
                            <a href="#raspinode-details" class="small-box-footer">Wallet details <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>

                <div class="row">

                    <!-- Warning  widget -->
                    <div class="col-lg-4 col-sm-4 col-xs-12 local-widget disable-if-stopped" style="display: none;">
                        <!-- small box -->
                        <div class="small-box bg-red">
                            <div class="inner">
                                <h3 class="widget-warning"><i class="ion spin ion-load-c"></i></h3>
                                <p>Local miner</p>
                            </div>
                            <div class="icon"><i class="ion ion-alert"></i></div>
                            <a href="" class="small-box-footer warning-message" data-toggle="tooltip" title="" data-original-title="Your local miner is offline, try to restart it. If you are in trouble check your logs and settings.">...<i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <!-- Stopped  widget -->
                    <?php if (!$this->redis->get("minerd_status")) : ?>
                        <div class="col-lg-4 col-sm-4 col-xs-12 enable-if-not-running local-widget" style="display: none;">
                            <!-- small box -->
                            <div class="small-box bg-gray">
                                <div class="inner">
                                    <h3 class="widget-warning">Offline</h3>
                                    <p>Local miner</p>
                                </div>
                                <div class="icon"><i class="ion ion-power"></i></div>
                                <a href="#" data-miner-action="start" class="miner-action small-box-footer warning-message" data-toggle="tooltip" title="" data-original-title="Your local miner is offline, try to restart it.">Try to start it <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- sys temp widget -->
                    <div class="col-lg-4 col-sm-4 col-xs-12 local-widget">
                        <!-- small box -->
                        <div class="small-box sys-temp-box bg-blue">
                            <div class="inner">
                                <h3 class="widget-sys-temp"><i class="ion spin ion-load-c"></i></h3>
                                <p>System temperature</p>
                            </div>
                            <div class="icon"><i class="ion ion-thermometer"></i></div>
                            <a href="#sysload" class="small-box-footer sys-temp-footer">...<i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <!-- main pool -->
                    <div class="col-lg-4 col-sm-4 col-xs-12 disable-if-not-running">
                        <!-- small box -->
                        <div class="small-box bg-dark">
                            <div class="inner">
                                <h3 class="widget-main-pool"><i class="ion spin ion-load-c"></i></h3>
                                <p>Your weight</p>
                            </div>
                            <div class="icon"><i class="ion ion-ios-cloud-upload-outline"></i></div>
                            <a href="#weight-history" class="small-box-footer">Your weight details <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <!-- uptime widget -->
                    <div class="col-lg-4 col-sm-4 col-xs-12 disable-if-not-running">
                        <!-- small box -->
                        <div class="small-box bg-aqua">
                            <div class="inner">
                                <h3 class="widget-uptime"><i class="ion spin ion-load-c"></i></h3>
                                <p>RaspiNode uptime</p>
                            </div>
                            <div class="icon"><i class="ion ion-ios-timer-outline"></i></div>
                            <a href="#raspinode-details" class="small-box-footer uptime-footer">... <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                </div>
            </section>
            <?php if ($dashboardBoxChartSystemLoad) : ?>
                <section class="col-md-6 col-xs-12 connectedSortable ui-sortable left-section">
                    <!-- System box -->
                    <div class="box box-light <?php if (isset($boxStatuses['box-chart-system-load']) && !$boxStatuses['box-chart-system-load']) : ?>collapsed-box<?php endif; ?>" id="box-chart-system-load">
                        <div class="overlay"></div>
                        <div class="loading-img"></div>
                        <div class="box-header" style="cursor: move;">
                            <!-- tools box -->
                            <div class="pull-right box-tools">
                                <button class="btn btn-default btn-xs" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse"><i class="fa fa-minus"></i></button>
                            </div><!-- /. tools -->
                            <i class="fa fa-tasks"></i>

                            <h3 class="box-title" id="sysload">System Load</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body" style="display: block;">
                            <div class="row padding-vert sysload" ></div>
                        </div><!-- /.box-body -->
                        <div class="box-footer">
                            <h6 class="sysuptime"></h6>
                        </div>
                    </div><!-- /.system box -->
                </section>
            <?php endif; ?>
            <?php if ($dashboardBoxChartHashrates) : ?>
                <section class="col-md-6 col-xs-12 connectedSortable ui-sortable left-section">
                    <!-- Hashrate box chart -->
                    <div class="box box-primary <?php if (isset($boxStatuses['box-chart-hashrates']) && !$boxStatuses['box-chart-hashrates']) : ?>collapsed-box<?php endif; ?>" id="box-chart-hashrates">
                        <div class="overlay"></div>
                        <div class="loading-img"></div>
                        <div class="box-header">
                            <!-- tools box -->
                            <div class="pull-right box-tools">
                                <button class="btn btn-default btn-xs" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse"><i class="fa fa-minus"></i></button>
                            </div><!-- /. tools -->
                            <i class="fa fa-bar-chart-o"></i>

                            <h3 class="box-title" id="weight-history">Weight History</h3>
                        </div>
                        <div class="box-body chart-responsive">
                            <div class="chart" id="hashrate-chart" style="height:160px;"></div>
                        </div>
                    </div><!-- /.hashrate box -->
                </section>
            <?php endif; ?>

            <!-- Top section -->
            <section class="hidden-xs col-md-12 connectedSortable ui-sortable top-section">
                <?php if ($dashboardBoxProfit and FALSE) : ?>
                    <!-- Profit box -->
                    <div class="box box-light <?php if (isset($boxStatuses['box-profit']) && !$boxStatuses['box-profit']) : ?>collapsed-box<?php endif; ?>" id="box-profit">
                        <div class="overlay"></div>
                        <div class="loading-img"></div>
                        <div class="box-header" style="cursor: move;">
                            <!-- tools box -->
                            <div class="pull-right box-tools">
                                <button class="btn btn-default btn-xs" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse"><i class="fa fa-minus"></i></button>
                            </div><!-- /. tools -->
                            <i class="fa fa-line-chart"></i>

                            <h3 class="box-title" id="raspinode-details">Staking profitability <small class="profit-whatmine"></small></h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-sm-2">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-dashboard"></i></span>
                                        <input type="number" class="form-control profit_hashrate" placeholder="Hashrate" name="profit_hashrate" value="" />
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <select name="profit_unit" class="form-control profit_data profit_unit">
                                        <option value="1000000000" data-profit-unit="PH/s">PH/s</option>
                                        <option value="1000000" data-profit-unit="TH/s">TH/s</option>
                                        <option value="1000" data-profit-unit="GH/s">GH/s</option>
                                        <option value="1" data-profit-unit="MH/s" selected>MH/s</option>
                                        <option value="0.001" data-profit-unit="KH/s">KH/s</option>
                                    </select>
                                </div>
                                <div class="col-sm-2">
                                    <select name="profit_period" class="form-control profit_data profit_period">
                                        <option value="0.0416" data-profit-period="Hour">Hour</option>
                                        <option value="1" data-profit-period="Day" selected>Day</option>
                                        <option value="7" data-profit-period="Week">Week</option>
                                        <option value="30" data-profit-period="Month">Month</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <h6><i class="fa fa-btc"></i> Earnings column calculation data: <span class="label label-primary profit_local_hashrate"></span> <span class="label label-info profit_local_period">Day</span></h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="profit-table-details-error"></div>
                                    <div class="">
                                        <table id="profit-table-details" class="responsive-datatable-minera table table-striped datatable">
                                            <thead>
                                                <tr>
                                                    <th><i class="fa fa-money"></i> Coin</th>
                                                    <th><i class="fa fa-bullseye"></i> Difficulty</th>
                                                    <th><i class="fa fa-trophy"></i> Reward</th>
                                                    <th><i class="fa fa-th"></i> Blocks</th>
                                                    <th><i class="fa fa-dashboard"></i> Hash Rate</th>
                                                    <th><i class="fa fa-exchange"></i> Exchange Rate</th>
                                                    <th><i class="fa fa-btc"></i> Earnings</th>
                                                    <th>BTC / Unit</th>
                                                    <th>Coins / Unit</th>
                                                    <th>Algorithm</th>
                                                </tr>
                                            </thead>
                                            <tbody class="profit_table">
                                            </tbody>
                                            <tfoot class="profit_table_foot">
                                            </tfoot>
                                        </table><!-- /.table -->
                                    </div>
                                </div>
                            </div><!-- /.row - inside box -->
                        </div><!-- /.box-body -->
                        <div class="box-footer">
                            <h6>Exchange rates taken by Poloniex are updated every 10 minutes</h6>
                            <h6>Everything else are (almost) in real time. Profit formula is: <i>( time / (difficulty * 2^32) / hashrate ) * reward</i></h6>
                            <h6>Unit are 1MH/s for Scrypt and 1GH/s for SHA256</h6>
                        </div>
                    </div><!-- /.profit box -->
                <?php endif; ?>

                <?php if ($dashboardBoxLocalMiner) : ?>
                    <!-- Local Miner box -->
                    <div class="box box-light <?php if (isset($boxStatuses['box-local-miner']) && !$boxStatuses['box-local-miner']) : ?>collapsed-box<?php endif; ?>" id="box-local-miner">
                        <div class="overlay"></div>
                        <div class="loading-img"></div>
                        <div class="box-header" style="cursor: move;">
                            <!-- tools box -->
                            <div class="pull-right box-tools">
                                <button class="btn btn-default btn-xs" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse"><i class="fa fa-minus"></i></button>
                            </div><!-- /. tools -->
                            <i class="fa fa-desktop"></i>

                            <h3 class="box-title" id="raspinode-details">PirateCash daemons details</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="">
                                        <table id="miner-table-details" class="responsive-datatable-minera table table-striped datatable">
                                            <thead>
                                                <tr>
                                                    <th>DEV</th>
                                                    <th>Temp</th>
                                                    <th>Weight</th>
                                                    <th>AC</th>
                                                    <th>% AC</th>
                                                    <th>RE</th>
                                                    <th>% RE</th>
                                                    <th>Last share</th>
                                                    <th>Last share time</th>
                                                </tr>
                                            </thead>
                                            <tbody class="devs_table">
                                            </tbody>
                                            <tfoot class="devs_table_foot">
                                            </tfoot>
                                        </table><!-- /.table -->
                                    </div>
                                </div>
                            </div><!-- /.row - inside box -->
                        </div><!-- /.box-body -->
                        <div class="box-footer">
                            <div class="legend pull-right">
                                <h6>Colors based on last stake time: <i class="fa fa-circle text-success"></i> Good&nbsp;&nbsp;&nbsp;<i class="fa fa-circle text-warning"></i> Low&nbsp;&nbsp;&nbsp;<i class="fa fa-circle text-danger"></i> Extra low&nbsp;&nbsp;&nbsp;<i class="fa fa-circle text-muted"></i> Probably you need more Pirates</h6>
                            </div>
                            <?php if ($savedFrequencies && $minerdRunning == "cpuminer") : ?>
                                <button class="btn btn-primary btn-sm btn-saved-freq" data-toggle="tooltip" title="" data-original-title="Look at saved frequencies"><i class="fa fa-eye"></i> Saved frequencies</button>
                            <?php else: ?>
                                &nbsp;
                            <?php endif; ?>
                            <div class="freq-box" style="display:none; margin-top:10px;">
                                <h6>You can find this on the <a href="<?php echo site_url("app/settings") ?>">settings page</a> too.</h6>
                                <pre id="miner-freq" style="font-size:10px; margin-top:10px;">--gc3355-freq=<?php echo $savedFrequencies ?></pre>
                            </div>
                        </div>
                    </div><!-- /.miner box -->
                <?php endif; ?>

            </section>

            <!-- Right col -->
            <section class="col-md-6 col-xs-12 connectedSortable ui-sortable right-section" id="box-charts">
                <?php if ($dashboardBoxChartShares) : ?>
                    <!-- A/R/H chart -->
                    <div class="box box-primary <?php if (isset($boxStatuses['box-chart-shares']) && !$boxStatuses['box-chart-shares']) : ?>collapsed-box<?php endif; ?>" id="box-chart-shares">
                        <div class="overlay"></div>
                        <div class="loading-img"></div>
                        <div class="box-header">
                            <!-- tools box -->
                            <div class="pull-right box-tools">
                                <button class="btn btn-default btn-xs" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse"><i class="fa fa-minus"></i></button>
                            </div><!-- /. tools -->
                            <i class="fa fa-bullseye"></i>

                            <h3 class="box-title" id="error-history">Accepted/Rejected blocks</h3>
                        </div>
                        <div class="box-body chart-responsive">
                            <div class="chart" id="rehw-chart" style="height:160px;"></div>
                        </div>
                    </div><!-- /.A/R/H chart -->
                <?php endif; ?>

            </section><!-- Right col -->

            <!-- Left col -->
            <section class="col-md-6 col-xs-12 connectedSortable ui-sortable left-section">


                <?php if ($dashboardBoxScryptEarnings and FALSE) : ?>
                    <!-- Profitability box -->
                    <div class="box box-dark <?php if (isset($boxStatuses['box-scrypt-earnings']) && !$boxStatuses['box-scrypt-earnings']) : ?>collapsed-box<?php endif; ?>" id="box-scrypt-earnings">
                        <div class="box-header" style="cursor: move;">
                            <!-- tools box -->
                            <div class="pull-right box-tools">
                                <button class="btn btn-default btn-xs" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse"><i class="fa fa-minus"></i></button>
                            </div><!-- /. tools -->
                            <i class="fa fa-signal"></i>

                            <h3 class="box-title">PoS Earnings calculator</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body" style="display: block;">
                            <div class="profitability-box">
                                <p>Profitability in PIRATE/Day <a href="#" class="profitability-question"><small class="badge bg-light"><small><i class="fa fa-question"></i></small></small></a></p>
                                <div class="callout callout-grey profitability-help" style="display:none;">
                                    <p><small>If you know the profitability of your pool you can select it sliding the bar to get your possible earnings based on your current pool hashrate. Profitability is usually expressed as <i class="fa fa-btc"></i> per day per MH/s. You can see for example the <a href="http://www.clevermining.com/profits/30-days" target="_blank">Clevermining one, here</a>.</small></p>
                                </div>
                                <div class="margin-bottom">
                                    <input type="text" name="default_profitability" id="profitability-slider" value="" />
                                </div>
                            </div>
                        </div><!-- /.box-body -->
                        <div class="box-footer">
                            <div class="profitability-results"><small>Drag and slide the bar above to set your pool profitability and calculate your current possible earnings.</small></div>
                        </div>
                    </div><!-- /.tree box -->
                <?php endif; ?>

            </section><!-- /.left col -->

        </div><!-- /.row -->

        <div class="row">

            <!-- Bottom section -->
            <section class="col-md-12 connectedSortable ui-sortable bottom-section">

                <?php if ($dashboardDevicetree) : ?>
                    <!-- Tree box -->
                    <div class="box box-dark <?php if (isset($boxStatuses['box-device-tree']) && !$boxStatuses['box-device-tree']) : ?>collapsed-box<?php endif; ?>" id="box-device-tree">
                        <div class="overlay"></div>
                        <div class="loading-img"></div>
                        <div class="box-header" style="cursor: move;">
                            <!-- tools box -->
                            <div class="pull-right box-tools">
                                <button class="btn btn-default btn-xs" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse"><i class="fa fa-minus"></i></button>
                            </div><!-- /. tools -->
                            <i class="fa fa-sitemap"></i>

                            <h3 class="box-title">Device Tree</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body" style="display: block;">
                            <div class="row padding-vert" id="devs-total" ></div>
                            <div class="row padding-vert" id="devs"></div>
                        </div><!-- /.box-body -->
                    </div><!-- /.tree box -->
                <?php endif; ?>

                <?php if ($dashboardBoxLog) : ?>
                    <!-- Real time log box -->
                    <div class="box box-light <?php if (isset($boxStatuses['box-log']) && !$boxStatuses['box-log']) : ?>collapsed-box<?php endif; ?>" id="box-log">
                        <div class="box-header" style="cursor: move;">
                            <!-- tools box -->
                            <div class="pull-right box-tools">
                                <a href="" target="_blank" style="padding-right: 20px;"><button class="btn btn-default btn-xs"><i class="fa fa-briefcase"></i> view raw log</button></a>
                                <button class="btn btn-default btn-xs pause-log" data-widget="pause" data-toggle="tooltip" title="" data-original-title="Pause Log"><i class="fa fa-pause"></i></button>
                                <button class="btn btn-default btn-xs" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse"><i class="fa fa-minus"></i></button>
                            </div><!-- /. tools -->
                            <i class="fa fa-file-o"></i>

                            <h3 class="box-title" id="pools-details">Piratecashd real time log</h3>
                        </div>
                        <div class="box-body">
                            <?php if ($minerdLog) : ?>
                                <pre class="log-box" id="real-time-log-data">Logger is in pause, click play to resume it.</pre>
                            <?php else: ?>
                                <pre>Please enable logging in the settings page to see the miner log here.</pre>
                            <?php endif; ?>
                        </div><!-- /.box-body -->
                        <div class="box-footer">
                            <h6>To download the full <a href="" target="_blank">raw log please click this link</a>.</h6>
                        </div>
                    </div><!-- /.miner box -->
                <?php endif; ?>
            </section>
        </div>

    </section><!-- /.content -->
</aside><!-- /.right-side -->
</div><!-- ./wrapper -->
