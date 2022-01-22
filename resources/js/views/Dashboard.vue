<template>
    <div class="container-fluid">
        <header-component title="Dashboard"></header-component>

        <div class="row">
            <div class="col-xl-5 col-lg-6">

                <div class="row">
                    <div class="col-lg-6">
                        <div class="card widget-flat">
                            <div class="card-body">
                                <div class="float-right">
                                    <i class="fa fa-users fa-2x"></i>
                                </div>
                                <h5 class="text-muted fw-normal mt-0" title="Number of Customers">Customers</h5>
                                <h3 class="mt-3 mb-3">36,254</h3>
                                <p class="mb-0 text-muted">
                                    <span class="text-success me-2"><i class="mdi mdi-arrow-up-bold"></i> 5.27%</span>
                                    <span class="text-nowrap">Since last month</span>  
                                </p>
                            </div> <!-- end card-body-->
                        </div> <!-- end card-->
                    </div> <!-- end col-->

                    <div class="col-lg-6">
                        <div class="card widget-flat">
                            <div class="card-body">
                                <div class="float-right">
                                    <i class="fa fa-truck fa-2x"></i>
                                </div>
                                <h5 class="text-muted fw-normal mt-0" title="Number of Orders">Orders</h5>
                                <h3 class="mt-3 mb-3">5,543</h3>
                                <p class="mb-0 text-muted">
                                    <span class="text-danger me-2"><i class="mdi mdi-arrow-down-bold"></i> 1.08%</span>
                                    <span class="text-nowrap">Since last month</span>
                                </p>
                            </div> <!-- end card-body-->
                        </div> <!-- end card-->
                    </div> <!-- end col-->
                </div> <!-- end row -->
            </div> <!-- end col -->

            <div class="col-xl-7 col-lg-6">
                <div class="card card-h-100">
                    <div class="card-body">
                        <div class="dropdown float-right">
                            <a href="#" class="dropdown-toggle arrow-none card-drop" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-ellipsis-v"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Sales Report</a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Export Report</a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Profit</a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Action</a>
                            </div>
                        </div>
                        <h4 class="header-title mb-3">Projections Vs Actuals</h4>

                        <div dir="ltr" style="position: relative;">
                            <div dir="ltr"></div>
                            <div class="resize-triggers">
                                <div class="expand-trigger">
                                    <div style="width: 550px; height: 258px;"></div>
                                </div>
                                <div class="contract-trigger"></div>
                            </div>
                        </div>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->

            </div> <!-- end col -->
        </div>
    </div>

</template>

<script>
    export default {
        data() {
            return {
                // 
            }
        }
    }
</script>
