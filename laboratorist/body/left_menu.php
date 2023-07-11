<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li>
                    <a href="<?php echo BASEPATH;?>/laboratorist" class="waves-effect">
                        <i class="ri-dashboard-line"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li> 
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-medical-bag"></i>
                        <span>Blood Bank</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="<?php echo BASEPATH;?>/laboratorist/blood-bank/all">All Blood Group</a></li>
                        <li><a href="<?php echo BASEPATH;?>/laboratorist/blood-bank/add">Add Blood Group</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-medical-bag"></i>
                        <span>Test Type</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="<?php echo BASEPATH;?>/laboratorist/test-type/add">Add Test Type</a></li>
                        <li><a href="<?php echo BASEPATH;?>/laboratorist/test-type/all">All Test Type</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-medical-bag"></i>
                        <span>Report</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="<?php echo BASEPATH;?>/laboratorist/report/add">Add Test Report</a></li>
                        <li><a href="<?php echo BASEPATH;?>/laboratorist/report/all">All Test Report</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-settings-2-line align-middle me-1"></i>
                        <span>Settings</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="<?php echo BASEPATH;?>/laboratorist/profile">Profile</a></li>
                        <li><a href="<?php echo BASEPATH;?>/laboratorist/change-password">Change Password</a></li>
                        <li><a href="?status=logout">Logout</a></li>
                    </ul>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->

