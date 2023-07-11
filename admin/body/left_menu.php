<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li>
                    <a href="<?php echo BASEPATH;?>/admin" class="waves-effect">
                        <i class="ri-dashboard-line"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-pencil-ruler-2-line"></i>
                        <span>Department</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="<?php echo BASEPATH;?>/admin/department/add">Add Department</a></li>
                        <li><a href="<?php echo BASEPATH;?>/admin/department/all">All Department</a></li>
                    </ul>
                </li> 
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-doctor"></i>
                        <span>Doctor</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="<?php echo BASEPATH;?>/admin/doctor/add">Add Doctor</a></li>
                        <li><a href="<?php echo BASEPATH;?>/admin/doctor/all">All Doctor</a></li>
                        <li><a href="<?php echo BASEPATH;?>/admin/doctor/edit_request">Edit Request</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-doctor"></i>
                        <span>Nurse</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="<?php echo BASEPATH;?>/admin/nurse/add">Add Nurse</a></li>
                        <li><a href="<?php echo BASEPATH;?>/admin/nurse/all">All Nurse</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-doctor"></i>
                        <span>Pharmacist</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="<?php echo BASEPATH;?>/admin/pharmacist/add">Add Pharmacist</a></li>
                        <li><a href="<?php echo BASEPATH;?>/admin/pharmacist/all">All Pharmacist</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-medical-bag"></i>
                        <span>Medicine</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="<?php echo BASEPATH;?>/admin/medicine/add-category">Add Category</a></li>
                        <li><a href="<?php echo BASEPATH;?>/admin/medicine/all-category">All Category</a></li>
                        <li><a href="<?php echo BASEPATH;?>/admin/medicine/add-medicine">Add Medicine</a></li>
                        <li><a href="<?php echo BASEPATH;?>/admin/medicine/all-medicine">All Medicine</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-doctor"></i>
                        <span>Laboratorist</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="<?php echo BASEPATH;?>/admin/laboratorist/add">Add Laboratorist</a></li>
                        <li><a href="<?php echo BASEPATH;?>/admin/laboratorist/all">All Laboratorist</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-medical-bag"></i>
                        <span>Blood Bank</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="<?php echo BASEPATH;?>/admin/blood-bank/all">All Blood Group</a></li>
                        <li><a href="<?php echo BASEPATH;?>/admin/blood-bank/add">Add Blood Group</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-bed"></i>
                        <span>Manage Bed</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="<?php echo BASEPATH;?>/admin/floor/all">All Floor</a></li>
                        <li><a href="<?php echo BASEPATH;?>/admin/floor/add">Add Floor</a></li>
                        <li><a href="<?php echo BASEPATH;?>/admin/bed/all">All Bed</a></li>
                        <li><a href="<?php echo BASEPATH;?>/admin/bed/add">Add Bed</a></li>
                    </ul>
                </li>
                <li style="display:none;">
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-account-circle-line"></i>
                        <span>Accountant</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="<?php echo BASEPATH;?>/admin/accountant/add">Add Accountant</a></li>
                        <li><a href="<?php echo BASEPATH;?>/admin/accountant/all">All Accountant</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-av-timer"></i>
                        <span>Manage Shedule</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="<?php echo BASEPATH;?>/admin/shedule/all">All Shedule</a></li>
                        <li><a href="<?php echo BASEPATH;?>/admin/shedule/all-appointmented-shedule">All Appointmented Shedule</a></li>
                        <li><a href="<?php echo BASEPATH;?>/admin/shedule/add">Add Shedule</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-av-timer"></i>
                        <span>Appointment</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="<?php echo BASEPATH;?>/admin/appointment/all">All Appointment</a></li>
                        <li><a href="<?php echo BASEPATH;?>/admin/appointment/all-appointment-request">All Requested Appointment</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-account-circle-line"></i>
                        <span>Patient</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="<?php echo BASEPATH;?>/admin/patient/add">Add Patient</a></li>
                        <li><a href="<?php echo BASEPATH;?>/admin/patient/all">All Patient</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-medical-bag"></i>
                        <span>Test Type</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="<?php echo BASEPATH;?>/admin/test-type/add">Add Test Type</a></li>
                        <li><a href="<?php echo BASEPATH;?>/admin/test-type/all">All Test Type</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-medical-bag"></i>
                        <span>Report</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="<?php echo BASEPATH;?>/admin/report/all">All Report</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-timer"></i>
                        <span>Admit</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="<?php echo BASEPATH;?>/admin/admit/all">All Admit</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-timer"></i>
                        <span>Dead Report</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="<?php echo BASEPATH;?>/admin/dead-report/add">Add Report</a></li>
                        <li><a href="<?php echo BASEPATH;?>/admin/dead-report/all">All Report</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-timer"></i>
                        <span>Birth Report</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="<?php echo BASEPATH;?>/admin/birth-report/add">Add Report</a></li>
                        <li><a href="<?php echo BASEPATH;?>/admin/birth-report/all">All Report</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-notification-3-line"></i>
                        <span>Notice</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="<?php echo BASEPATH;?>/admin/notice/add">Add Notice</a></li>
                        <li><a href="<?php echo BASEPATH;?>/admin/notice/all">All Notice</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-settings-2-line align-middle me-1"></i>
                        <span>Settings</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="<?php echo BASEPATH;?>/admin/settings">Settings</a></li>
                        <li><a href="<?php echo BASEPATH;?>/admin/log_report">User Log Report</a></li>
                        <li><a href="<?php echo BASEPATH;?>/admin/profile">Profile</a></li>
                        <li><a href="<?php echo BASEPATH;?>/admin/change-password">Change Password</a></li>
                        <li><a href="?status=logout">Logout</a></li>
                    </ul>
                </li> 
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->

