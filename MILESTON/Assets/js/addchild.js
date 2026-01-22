document.addEventListener("DOMContentLoaded", () => {

  const ADD_CHILD_API = "http://localhost/MILESTON/api_proxy.php";

  const uploadBtn = document.getElementById("uploadBtn");
  const fileInput = document.getElementById("fileInput");
  const fileName = document.getElementById("fileName");
  const dobInput = document.getElementById("childDob");

  flatpickr(dobInput, {
    dateFormat: "Y-m-d",
    maxDate: "today"
  });

  uploadBtn.addEventListener("click", () => fileInput.click());
  fileInput.addEventListener("change", () => {
    fileName.innerText = fileInput.files.length
      ? fileInput.files[0].name
      : "Upload child’s picture";
  });

  function convertDOB(dateStr) {
    const d = new Date(dateStr);
    const day = String(d.getDate()).padStart(2, "0");
    const month = String(d.getMonth() + 1).padStart(2, "0");
    const year = d.getFullYear();
    return `${day}/${month}/${year}`;
  }

  const form = document.getElementById("childForm");

  form.addEventListener("submit", async (e) => {
    e.preventDefault();

    const childName = document.getElementById("childName").value.trim();
    const center = document.getElementById("childCenter").value;
    const dob = dobInput.value;
    const genderEl = document.querySelector('input[name="gender"]:checked');

    if (!fileInput.files[0]) return alert("Please upload image");
    if (!childName) return alert("Enter child name");
    if (!dob) return alert("Select DOB");
    if (!genderEl) return alert("Select gender");
    if (!center) return alert("Select center");

    const formattedDOB = convertDOB(dob);

    const fd = new FormData();
    fd.append("childImage", fileInput.files[0]);
    fd.append("user_id", localStorage.getItem("userId") || "18");
    fd.append("childName", childName);
    fd.append("dob", formattedDOB);
    fd.append("gender", genderEl.value.toLowerCase());
    fd.append("center", center);

    const submitBtn = document.getElementById("submitBtn");
    submitBtn.innerText = "Processing...";
    submitBtn.disabled = true;

    try {
      const response = await fetch(ADD_CHILD_API, {
        method: "POST",
        body: fd
      });

      const result = await response.json();
      console.log(result);

      if (result.status == true || result.status == "true" || result.status == 1 || result.status == "1") {
        alert("Child added successfully!");
      }
      else {
        alert("Error: " + result.message);
      }



    } catch (err) {
      alert("Server error: " + err);
    }

    submitBtn.innerText = "Submit";
    submitBtn.disabled = false;

  });

});



