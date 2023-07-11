<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">
    
    <div data-simplebar class="h-100">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li>
                    <a href="<?php echo BASEPATH;?>/accountant" class="waves-effect">
                        <i class="ri-dashboard-line"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-doctor"></i>
                        <span>Doctor Fee</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="<?php echo BASEPATH;?>/accountant/doctor-fee/all">All Doctor Fee</a></li>
                        <li><a href="<?php echo BASEPATH;?>/accountant/doctor-fee/add">Add Doctor Fee</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-bed"></i>
                        <span>Bed Fee</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="<?php echo BASEPATH;?>/accountant/bed-fee/all">All Bed Fee</a></li>
                        <li><a href="<?php echo BASEPATH;?>/accountant/bed-fee/add">Add Bed Fee</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-bed"></i>
                        <span>Test Fee</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="<?php echo BASEPATH;?>/accountant/test-fee/all">All Test Fee</a></li>
                        <li><a href="<?php echo BASEPATH;?>/accountant/test-fee/add">Add Test Fee</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-bed"></i>
                        <span>All Bill</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="<?php echo BASEPATH;?>/accountant/bill/appointment-bill-all">All Appointment Bill</a></li>
                        <li><a href="<?php echo BASEPATH;?>/accountant/bill/appointment-bill-add">Add Appointment Bill</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-settings-2-line align-middle me-1"></i>
                        <span>Settings</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="<?php echo BASEPATH;?>/accountant/profile">Profile</a></li>
                        <li><a href="<?php echo BASEPATH;?>/accountant/change-password">Change Password</a></li>
                        <li><a href="?status=logout">Logout</a></li>
                    </ul>
                </li> 
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->

