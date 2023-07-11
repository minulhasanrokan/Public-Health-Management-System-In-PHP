<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li>
                    <a href="<?php echo BASEPATH;?>/doctor" class="waves-effect">
                        <i class="ri-dashboard-line"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-doctor"></i>
                        <span>Nurse</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="<?php echo BASEPATH;?>/doctor/nurse/all">All Nurse</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-av-timer"></i>
                        <span>Manage Shedule</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="<?php echo BASEPATH;?>/doctor/shedule/all">All Shedule</a></li>
                        <li><a href="<?php echo BASEPATH;?>/doctor/shedule/all-appointmented-shedule">All Appointmented Shedule</a></li>
                        <li><a href="<?php echo BASEPATH;?>/doctor/shedule/add">Add Shedule</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-timer"></i>
                        <span>Appointment</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="<?php echo BASEPATH;?>/doctor/appointment/all-appointment-request">All Appointment Request</a></li>
                        <li><a href="<?php echo BASEPATH;?>/doctor/appointment/all-appointment">All Appointment</a></li>
                        <li><a href="<?php echo BASEPATH;?>/doctor/appointment/next-visit-appointment">Next Visit Appointment</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-timer"></i>
                        <span>Admit</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="<?php echo BASEPATH;?>/doctor/admit/all">All Admit</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-timer"></i>
                        <span>Dead Report</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="<?php echo BASEPATH;?>/doctor/dead-report/add">Add Report</a></li>
                        <li><a href="<?php echo BASEPATH;?>/doctor/dead-report/all">All Report</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-timer"></i>
                        <span>Birth Report</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="<?php echo BASEPATH;?>/doctor/birth-report/add">Add Report</a></li>
                        <li><a href="<?php echo BASEPATH;?>/doctor/birth-report/all">All Report</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-settings-2-line align-middle me-1"></i>
                        <span>Settings</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="<?php echo BASEPATH;?>/doctor/profile">Profile</a></li>
                        <li><a href="<?php echo BASEPATH;?>/doctor/change-password">Change Password</a></li>
                        <li><a href="?status=logout">Logout</a></li>
                    </ul>
                </li> 
                
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->

