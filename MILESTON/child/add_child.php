<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Add a Child</title>

    <link href="https://fonts.googleapis.com/css2?family=Livvic:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.js"></script>
    <style>
/* ===============================
   PAGE BACKGROUND
================================ */
body {
  margin: 0;
  min-height: 100vh;
  background: #fef5dd;
  font-family: "Livvic", sans-serif;
  display: flex;
  justify-content: center;
  align-items: flex-start;
  padding: 30px 0;
}

/* ===============================
   FORM CARD
================================ */
#childForm {
  background: #ffffff;
  width: 100%;
  max-width: 520px;
  padding: 28px 26px 30px;
  border-radius: 18px;
  box-shadow: 0 8px 25px rgba(0,0,0,0.12);
}

/* ===============================
   UPLOAD
================================ */
.upload-box {
  display: flex;
  align-items: center;
  gap: 14px;
  border: 2px solid #ffcc7f;
  border-radius: 14px;
  padding: 12px 14px;
  margin-bottom: 22px;
  background: #fff6e5;
}

.upload-btn {
  background: #ff9f0a;
  border: none;
  padding: 9px 20px;
  border-radius: 12px;
  color: #fff;
  font-weight: 600;
  cursor: pointer;
}

.upload-text {
  font-size: 14px;
  color: #5a5a5a;
}

/* ===============================
   LABELS
================================ */
.label {
  display: block;
  font-weight: 600;
  color: #5a5a5a;
  margin-bottom: 6px;
  margin-top: 12px;
}

/* ===============================
   INPUTS
================================ */
.input {
  width: 95%;
  padding: 13px 15px;
  border-radius: 14px;
  border: 2px solid #ffcc7f;
  font-size: 15px;
  outline: none;
  margin-bottom: 18px;
}

.input::placeholder {
  color: #9b9b9b;
}

/* ===============================
   DOB
================================ */
.dob-wrapper {
  position: relative;
}

.dob-icon {
  position: absolute;
  right: 10px;
  top: 35%;
  transform: translateY(-50%);
  background: #fe9900;
  padding: 7px 9px;
  border-radius: 10px;
  font-size: 16px;
  color: #fff;
  cursor: pointer;
}

/* ===============================
   RADIO (GENDER)
================================ */
.option-row {
  display: flex;
  justify-content: space-between;
  align-items: center;
  border: 2px solid #ffcc7f;
  border-radius: 14px;
  padding: 14px 18px;
  margin-bottom: 22px;
}

.option-row label {
  font-weight: 500;
  color: #444;
  display: flex;
  align-items: center;
  gap: 6px;
}

/* ===============================
   CENTER SELECT
================================ */
.center-wrapper {
  display: flex;
  margin-bottom: 28px;
}

.center-label-box {
  background: linear-gradient(90deg, #E58D00, #F3C73F);
  padding: 14px 22px;
  border-radius: 14px 0 0 14px;
  font-weight: 600;
  color: #000;
}

.center-select-box {
  flex: 1;
  border: 2px solid #F3C73F;
  border-left: none;
  border-radius: 0 14px 14px 0;
  background: #fff;
  position: relative;
}

.center-select-box select {
  width: 100%;
  height: 100%;
  border: none;
  padding: 14px 16px;
  font-size: 15px;
  background: transparent;
  outline: none;
  cursor: pointer;
}

/* dropdown arrow */
.center-select-box::after {
  position: absolute;
  right: 14px;
  top: 50%;
  transform: translateY(-50%);
  pointer-events: none;
  font-size: 16px;
}

/* ===============================
   SUBMIT BUTTON
================================ */
.button-row {
  display: flex;
  justify-content: center;
}

.submit-btn {
  background: #ff9600;
  border: none;
  padding: 14px 48px;
  border-radius: 30px;
  font-size: 18px;
  font-weight: 600;
  color: #fff;
  cursor: pointer;
  box-shadow: 0 6px 14px rgba(255,150,0,0.4);
}

/* ===============================
   MOBILE
================================ */
@media (max-width: 480px) {
  #childForm {
    padding: 24px 18px;
  }

  .option-row {
    flex-direction: column;
    gap: 12px;
    align-items: flex-start;
  }
}


/* ===============================
   EXTRA SMALL DEVICES (≤360px)
================================ */
@media (max-width: 360px) {
  .page {
    padding: 12px;
    max-width: 100%;
  }

  .title {
    font-size: 20px;
  }

  .card {
    padding: 20px;
  }

  .upload-box,
  .input,
  .option-row {
    width: 100%;
  }

  .center-label-box {
    font-size: 13px;
    padding: 12px 16px;
  }

  .center-select-box select {
    font-size: 14px;
  }

  .next-btn,
  .prev-btn {
    font-size: 14px;
    padding: 9px 16px;
  }
}

/* ===============================
   SMALL MOBILE (≤480px)
================================ */
@media (max-width: 480px) {
  .title {
    font-size: 22px;
  }

  .title-underline {
    width: 90px;
  }

  .button-row {
    flex-direction: column;
    gap: 12px;
  }

  .next-btn,
  .prev-btn {
    width: 100%;
    justify-content: center;
  }
}

/* ===============================
   MOBILE / PHABLET (≤600px)
================================ */
@media (max-width: 600px) {
  .upload-box {
    flex-direction: column;
    align-items: flex-start;
    gap: 10px;
  }

  .upload-btn {
    width: 100%;
    text-align: center;
  }

  .upload-text {
    padding-left: 0;
    font-size: 13px;
  }

  .center-wrapper {
    width: 100%;
  }
}

/* ===============================
   TABLET (≤768px)
================================ */
@media (max-width: 768px) {
  .page {
    max-width: 520px;
  }

  .card {
    padding: 25px;
  }

  .title {
    font-size: 23px;
  }
}

/* ===============================
   SMALL LAPTOP (≤1024px)
================================ */
@media (max-width: 1024px) {
  .page {
    max-width: 600px;
  }

  .title {
    font-size: 24px;
  }
}

/* ===============================
   DESKTOP (≥1200px)
================================ */
@media (min-width: 1200px) {
  .page {
    max-width: 650px;
  }

  .title {
    font-size: 26px;
  }

  .card {
    padding: 32px;
  }
}

/* ===============================
   EXTRA LARGE / 2XL (≥1440px)
================================ */
@media (min-width: 1440px) {
  .page {
    max-width: 720px;
  }

  .title {
    font-size: 28px;
  }

  .card {
    padding: 36px;
  }

  .next-btn {
    font-size: 17px;
    padding: 12px 30px;
  }
}

/* ===============================
   ULTRA WIDE / 4K (≥1800px)
================================ */
@media (min-width: 1800px) {
  .page {
    max-width: 800px;
  }

  .title {
    font-size: 30px;
  }

  .card {
    padding: 40px;
  }
}
        /* Added style for API feedback */
        #apiStatus {
            text-align: center;
            margin-top: 15px;
            font-weight: 600;
            padding: 10px;
            border-radius: 8px;
            display: none;
        }
        .status-success { color: #28a745; background: #e8f5e9; }
        .status-error { color: #dc3545; background: #ffebee; }

</style>
</head>

<body>
    <form id="childForm" enctype="multipart/form-data">
        <input type="hidden" name="userId" value="18">

        <div class="upload-box">
            <input type="file" id="fileInput" name="image" accept="image/*" hidden required>
            <button type="button" class="upload-btn" id="uploadBtn">Upload</button>
            <span class="upload-text" id="fileName">Upload child’s picture</span>
        </div>

        <label class="label">Child Name</label>
        <input type="text" class="input" id="childName" name="childName" placeholder="Enter Child Name" required>

        <label class="label">Date of Birth</label>
        <div class="dob-wrapper">
            <input type="text" class="input dob-input" id="childDob" name="dob" placeholder="Select DOB" required>
            <span class="dob-icon" id="dobIcon">📅</span>
        </div>

        <label class="label">Gender</label>
        <div class="option-row">
            <label><input type="radio" name="gender" value="Male" required> Male</label>
            <label><input type="radio" name="gender" value="Female" required> Female</label>
        </div>

        <div class="center-wrapper">
            <div class="center-label-box">Center</div>
            <div class="center-select-box">
                <select id="childCenter" name="center" required>
                    <option value="">Choose nearby center</option>
                    <option value="Dhayari">Dhayari</option>
                    <option value="Khed Shivapur">Khed Shivapur</option>
                    <option value="Karve Nagar">Karve Nagar</option>
                </select>
            </div>
        </div>

        <div id="apiStatus"></div>

        <div class="button-row">
            <button type="submit" class="submit-btn" id="submitBtn">Submit</button>
        </div>
    </form>

    <script src="../Assets/js/addchild.js"></script>
</body>
</html>