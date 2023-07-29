<div class="modal fade " id="exampleModalToggle1" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content rounded py-3 rounded-5 shadow-none border-0">
      <div class="modal-header border-0" dir="rtl">
        <h5 class="modal-title" id="exampleModalToggleLabel"><bdo dir="rtl">چونه‌ ژووره‌وه‌</bdo></h5>
        <button type="button" class="btn-close btn-sm me-auto ms-1" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form class="modal-body" id="loginForm">
        <div class="form-group mb-3" dir="rtl">
          <label for="text" class="mb-1"><bdo dir="rtl">ناوی بەکارهێنەر یان ئیمێڵ</bdo></label>
          <input type="text" id="login_username" name="login_username" class="form-control rounded rounded-4 py-2">
        </div>
        <div class="form-group mb-3 position-relative password-input" dir="rtl">
          <label for="password" class="mb-1"><bdo dir="rtl">وشەی نهێنی</bdo></label>
          <input type="password" id="login_password" name="login_password" class="form-control rounded rounded-4 py-2">
          <button class="btn  position-absolute showHidePass border-0 outline-0" onclick="(showHide(this.parentElement))"><i class="bi bi-eye"></i></button>
        </div>
        <div class="input-group d-fex align-items-center justify-content-between" dir="rtl">

          <button class="btn btn-sm btn-outline-primary rounded rounded-4 border-0 loginBtnn" id="loginBtn"><bdo dir="rtl">چونه‌ ژووره‌وه‌</bdo></button>
          <small class="text-danger"><bdo dir="rtl" id="login-result"></bdo></small>

        </div>
      </form>
      <div class="modal-footer border-0">
        <small class="text-secondary me-auto">
          <a href="forgotPassword.php" class="btn border-0 outline-0" style="font-size: 12px;"><bdo dir="rtl">وشەی نهێنیت لەبیر کردووە؟</bdo></a>
        </small>
        <button class="btn border-0" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal"><small><bdo dir="rtl">ئەکاونتت نییە؟</bdo></small> </button>

      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content rounded py-3 rounded-5 shadow-none border-0">
      <div class="modal-header border-0" dir="rtl">
        <h5 class="modal-title" id="exampleModalToggleLabel"><bdo dir="rtl">خۆت تۆمار بکە</bdo></h5>
        <button type="button" class="btn-close btn-sm me-auto ms-1" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form class="modal-body" id="signupForm">
        <div class="form-group mb-3" dir="rtl">
          <label for="signup_username" class="mb-1"><bdo dir="rtl">ناوی بەکارهێنەر</bdo></label>
          <input type="text" id="signup_username" name="username" class="form-control rounded rounded-4 py-2">
        </div>
        <div class="form-group mb-3" dir="rtl">
          <label for="signup_email" class="mb-1"><bdo dir="rtl">ئیمەیڵ</bdo></label>
          <input type="email" id="signup_email" name="email" class="form-control rounded rounded-4 py-2">
        </div>
        <div class="form-group mb-3 position-relative password-input" dir="rtl">
          <label for="signup_password" class="mb-1"><bdo dir="rtl">وشەی نهێنی</bdo></label>
          <input type="password" id="signup_password" name="password" class="form-control rounded rounded-4 py-2">
          <button class="btn  position-absolute showHidePass border-0 outline-0" onclick="(showHide(this.parentElement))"><i class="bi bi-eye"></i></button>

        </div>
        <div class="form-group mb-3 position-relative password-input" dir="rtl">
          <label for="signup_repassword" class="mb-1"><bdo dir="rtl">دووبارە وشەی نهێنی بنووسەوە</bdo></label>
          <input type="password" id="signup_repassword" name="repassword" class="form-control rounded rounded-4 py-2">
          <button class="btn  position-absolute showHidePass border-0 outline-0" onclick="(showHide(this.parentElement))"><i class="bi bi-eye"></i></button>

        </div>
        <div class="input-group d-fex align-items-center justify-content-between" dir="rtl">
          <button class="btn btn-sm btn-outline-primary rounded rounded-4 border-0 loginBtnn" id="signupBtn"><bdo dir="rtl">تۆمار كردن</bdo></button>
          <small class="text-danger"><bdo dir="rtl" id="signup-result"></bdo></small>
        </div>
      </form>
      <div class="modal-footer border-0">
        <button class="btn border-0" data-bs-target="#exampleModalToggle1" data-bs-toggle="modal"><small><bdo dir="rtl">ئەکاونتم هەیە</bdo></small> </button>
      </div>
    </div>
  </div>
</div>