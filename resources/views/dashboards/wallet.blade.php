        <div class="row">
            <div class="col-md-8">
                <!--/Wizard-->
                <div class="row">
                    <div class="col-md-4 d-flex">
                        <div class="card wizard-card flex-fill">
                            <div class="card-body">
                                <p class="text-primary mt-0 mb-2">Total Balance</p>
                                <h5>${{number_format($data->total_available_balance, 2)}}</h5>
                                <p><a href="users.html">view details</a></p>
                                <span class="dash-widget-icon bg-1">
                                    <i class="fas fa-users"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 d-flex">
                        <div class="card wizard-card flex-fill">
                            <div class="card-body">
                                <p class="text-primary mt-0 mb-2">Total Credit Balance</p>
                                <h5>${{number_format($data->total_credit_balance, 2)}}</h5>
                                <p><a href="projects.html">view details</a></p>
                                
                                <span class="dash-widget-icon bg-1">
                                    <i class="fas fa-th-large"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 d-flex">
                        <div class="card wizard-card flex-fill">
                            <div class="card-body">
                                <p class="text-primary mt-0 mb-2">Total Debit Balance</p>
                                <h5>${{number_format($data->total_debit_balance, 2)}}</h5>
                                <p><a href="projects.html">view details</a></p>
                                
                                <span class="dash-widget-icon bg-1">
                                    <i class="fas fa-bezier-curve"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/Wizard-->
                <div class="row">
                    <div class="col-lg-12 d-flex">
                        <div class="card w-100">
                            <div class="card-body pt-0 pb-2">
                                <div class="card-header">
                                    <h5 class="card-title">Over view</h5>
                                </div>
                                <div id="chart" class="mt-4"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 d-flex">
                <div class="card w-100">
                    <div class="card-body pt-0">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-7">
                                    <p>Welcome back,</p>
                                    <h6 class="text-primary">{{Auth::user()->name}}</h6>
                                </div>
                                <div class="col-5 text-end">
                                    <span class="welcome-dash-icon bg-1">
                                        <i class="fas fa-user"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="account-balance">
                            <p>Account balance</p>
                            <h6>${{number_format($data->total_available_balance, 2)}} </h6>
                        </div>
                        <div class="mt-3">
                            <h6 class="text-primary">Payments</h6>
                            <div class="table-responsive">
                                <table class="table table-center table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-nowrap">Client or Freelancer</th>
                                            <th>Amount</th>
                                            <th class="text-end">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-nowrap">Sakib Khan</td>
                                            <td>$2222</td>
                                            <td class="text-end">Completed</td>
                                        </tr>
                                        <tr>
                                            <td class="text-nowrap">Pixel Inc Ltd</td>
                                            <td>$750</td>
                                            <td class="text-end">
                                                <a href="javascript:void(0);" class="btn btn-sm btn-success me-2"><i class="far fa-edit"></i></a>
                                                <a href="javascript:void(0);" class="btn btn-sm btn-danger me-2"><i class="far fa-trash-alt"></i></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-nowrap">Jon M Mullins</td>
                                            <td>$3150</td>
                                            <td class="text-end text-nowrap">Money released to Freelancer</td>
                                        </tr>
                                        <tr>
                                            <td class="text-nowrap">Rose M Milewski</td>
                                            <td>$1455</td>
                                            <td class="text-end text-nowrap">Money returned to Client</td>
                                        </tr>
                                        <tr>
                                            <td class="text-nowrap">Gerald K Myers</td>
                                            <td>$3000</td>
                                            <td class="text-end">
                                                <a href="javascript:void(0);" class="btn btn-sm btn-success me-2"><i class="far fa-edit"></i></a>
                                                <a href="javascript:void(0);" class="btn btn-sm btn-danger me-2"><i class="far fa-trash-alt"></i></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-nowrap">Marcin Kowalski</td>
                                            <td>$895</td>
                                            <td class="text-end">
                                                <a href="javascript:void(0);" class="btn btn-sm btn-success me-2"><i class="far fa-edit"></i></a>
                                                <a href="javascript:void(0);" class="btn btn-sm btn-danger me-2"><i class="far fa-trash-alt"></i></a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>