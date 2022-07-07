<?php if (isset($component)) { $__componentOriginal7b6721487b7b8dd63e67398e09f7d70f121b9aa3 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\AuthLayout::class, ['title' => 'Login']); ?>
<?php $component->withName('AuthLayout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
  <div class="d-flex flex-column flex-root" style="background-image: url(<?php echo e(asset('offices/img/lib.png')); ?>)">
    <div class="d-flex flex-column flex-column-fluid" >
      <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
        <a href="index.html" class="mb-12">
          <span class="glyphicon glyphicon-book"></span>
        </a>
        <div class="w-lg-500px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto" id="login_page">
          <form class="form w-100" novalidate="novalidate" id="form_login">
            <div class="text-center mb-10">
              <h1 class="text-dark mb-3" style="font-family: Nunito">Selamat Datang Di Perpustakaan Lumban Dolok</h1>
            </div>
            <div class="fv-row mb-10">
              <label class="form-label fs-6 fw-bolder text-dark" style="font-family: Nunito">Email</label>
              <input class="form-control form-control-lg form-control-solid br10" type="email" name="email" id="email_login" placeholder="Masukan Alamat Email Anda" autocomplete="off" />
            </div>
            <div class="fv-row mb-10">
              <div class="d-flex flex-stack mb-2">
                <label class="form-label fw-bolder text-dark fs-6 mb-0" style="font-family: Nunito">Kata Sandi</label>
                <a href="<?php echo e(route('office.auth.forgot')); ?>" class="link-primary fs-6 fw-bolder">Lupa Kata Sandi ?</a>
              </div>
              <input class="form-control form-control-lg form-control-solid br10" type="password" placeholder="Masukan Kata Sandi Anda" name="password" id="password_login" autocomplete="off" />
            </div>
            <div class="text-center">
              <button type="submit" id="tombol_login" class="btn btn-lg btn-primary w-100 mb-5 br10">
                <span class="indicator-label">Masuk</span>
                <span class="indicator-progress">Silahkan Tunggu...
                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
              </button>
            </div>
          </form>
        </div>
        
      </div>
    </div>
  </div>
  <?php $__env->startSection('custom_js'); ?>
    <script>
      auth_content('login_page');
    </script>
  <?php $__env->stopSection(); ?>
 <?php if (isset($__componentOriginal7b6721487b7b8dd63e67398e09f7d70f121b9aa3)): ?>
<?php $component = $__componentOriginal7b6721487b7b8dd63e67398e09f7d70f121b9aa3; ?>
<?php unset($__componentOriginal7b6721487b7b8dd63e67398e09f7d70f121b9aa3); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?><?php /**PATH /home/u7749512/public_html/rickaru.com/perpustakaan/resources/views/pages/office/auth/main.blade.php ENDPATH**/ ?>