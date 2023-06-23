 <!-- Menu -->

 <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
     <div class="app-brand demo">
         <a href="index.php" class="app-brand-link">
             <span class="app-brand-logo demo">
                 <img src="../assets/img/pngegg.png" alt="" height="40px" width="40px">
             </span>
             <span class=" demo menu-text fw-bolder ms-2" style="font-size: 20px;">Commerce</span>
         </a>

         <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
             <i class="bx bx-chevron-left bx-sm align-middle"></i>
         </a>
     </div>

     <div class="menu-inner-shadow"></div>

     <ul class="menu-inner py-1">
         <!-- Dashboard -->
         <li class="menu-item active">
             <a href="index.php" class="menu-link">
                 <i class="menu-icon tf-icons bx bx-home-circle"></i>
                 <div data-i18n="Analytics">Dashboard</div>
             </a>
         </li>

         <!-- Layouts -->

         <li class="menu-header small text-uppercase">
             <span class="menu-header-text">Pages</span>
         </li>

         <li class="menu-item">
             <a href="javascript:void(0);" class="menu-link menu-toggle">
                 <i class="menu-icon tf-icons bx bx-lock-open-alt"></i>
                 <div data-i18n="Authentications">Authentications</div>
             </a>
             <ul class="menu-sub">
                 <li class="menu-item">
                     <a href="auth-login-basic.php" class="menu-link" target="_blank">
                         <div data-i18n="Basic">Login</div>
                     </a>
                 </li>
                 <li class="menu-item">
                     <a href="auth-register-basic.php" class="menu-link" target="_blank">
                         <div data-i18n="Basic">Register</div>
                     </a>
                 </li>
             </ul>
         </li>

         <!-- Components -->
         <li class="menu-header small text-uppercase"><span class="menu-header-text">Categories</span></li>
         <!-- Cards -->
         <li class="menu-item">
             <a href="category.php" class="menu-link">
                 <i class="menu-icon tf-icons bx bx-collection"></i>
                 <div data-i18n="Basic">Category</div>
             </a>
         </li>
         <li class="menu-item">
             <a href="sub-category.php" class="menu-link">
                 <i class="menu-icon tf-icons bx bx-collection"></i>
                 <div data-i18n="Basic">Sub-Category</div>
             </a>
         </li>

         <li class="menu-item">
             <a href="product.php" class="menu-link">
                 <i class="menu-icon tf-icons bx bx-collection"></i>
                 <div data-i18n="Basic">Product</div>
             </a>
         </li>

         <li class="menu-header small text-uppercase"><span class="menu-header-text">Customer Order</span></li>
         <!-- Cards -->
         <li class="menu-item">
             <a href="../html/order.php" class="menu-link">
                 <i class="menu-icon tf-icons bx bx-collection"></i>
                 <div data-i18n="Basic">Orders</div>
             </a>
         </li>

         <li class="menu-header small text-uppercase"><span class="menu-header-text">Logout</span></li>
         <!-- Cards -->
         <li class="menu-item">
             <a class="dropdown-item" href="../config/logout.php">
                 <i class="bx bx-power-off me-2"></i>
                 <span class="align-middle">Log Out</span>
             </a>
         </li>
     </ul>
 </aside>
 <!-- / Menu -->