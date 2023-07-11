<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li>
                    <a href="<?php echo BASEPATH;?>/nurse" class="waves-effect">
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
                        <li><a href="<?php echo BASEPATH;?>/nurse/blood-bank/all">All Blood Group</a></li>
                        <li><a href="<?php echo BASEPATH;?>/nurse/blood-bank/add">Add Blood Group</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-bed"></i>
                        <span>Manage Bed</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="<?php echo BASEPATH;?>/nurse/floor/all">All Floor</a></li>
                        <li><a href="<?php echo BASEPATH;?>/nurse/floor/add">Add Floor</a></li>
                        <li><a href="<?php echo BASEPATH;?>/nurse/bed/all">All Bed</a></li>
                        <li><a href="<?php echo BASEPATH;?>/nurse/bed/add">Add Bed</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-av-timer"></i>
                        <span>Manage Shedule</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="<?php echo BASEPATH;?>/nurse/shedule/all">All Shedule</a></li>
                        <li><a href="<?php echo BASEPATH;?>/nurse/shedule/all-appointmented-shedule">All Appointmented Shedule</a></li>
                        <li><a href="<?php echo BASEPATH;?>/nurse/shedule/add">Add Shedule</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-timer"></i>
                        <span>Appointment</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="<?php echo BASEPATH;?>/nurse/appointment/all-appointment-request">All Appointment Request</a></li>
                        <li><a href="<?php echo BASEPATH;?>/nurse/appointment/all-appointment">All Appointment</a></li>
                        <li><a href="<?php echo BASEPATH;?>/nurse/appointment/need-to-admit">All Need To Admit</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-timer"></i>
                        <span>Report</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="<?php echo BASEPATH;?>/nurse/report/all">All Report</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-timer"></i>
                        <span>Admit</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="<?php echo BASEPATH;?>/nurse/admit/all">All Admit</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-timer"></i>
                        <span>Dead Report</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="<?php echo BASEPATH;?>/nurse/dead-report/add">Add Report</a></li>
                        <li><a href="<?php echo BASEPATH;?>/nurse/dead-report/all">All Report</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-timer"></i>
                        <span>Birth Report</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="<?php echo BASEPATH;?>/nurse/birth-report/add">Add Report</a></li>
                        <li><a href="<?php echo BASEPATH;?>/nurse/birth-report/all">All Report</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-settings-2-line align-middle me-1"></i>
                        <span>Settings</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="<?php echo BASEPATH;?>/nurse/profile">Profile</a></li>
                        <li><a href="<?php echo BASEPATH;?>/nurse/change-password">Change Password</a></li>
                        <li><a href="?status=logout">Logout</a></li>
                    </ul>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->

