document.addEventListener("DOMContentLoaded", () => {
 
//   const ADD_CHILD_API = "http://localhost/spaceece-main/milestone/api_proxy.php?action=add_child";
 
//     const API_CONFIG = {
//         baseURL: ADD_CHILD_API,
//         endpoints: {
//             addChild: "?action=add_child"
//         }
//     };
 
// const ADD_CHILD_API = "http://localhost/spacece-main/milestone/api_proxy.php";
const ADD_CHILD_API = "http://localhost/spacece-main/milestone/api_proxy.php";
const API_CONFIG = {
    baseURL: ADD_CHILD_API,
    endpoints: {
        addChild: ""
    }
};
 
    /* =====================================================
       FILE UPLOAD
    ===================================================== */
    const uploadBtn = document.getElementById("uploadBtn");
    const fileInput = document.getElementById("fileInput");
    const fileName  = document.getElementById("fileName");
    let uploadedImageData = null;
 
    uploadBtn.addEventListener("click", () => fileInput.click());
 
    fileInput.addEventListener("change", () => {
        if (fileInput.files[0]) {
            fileName.innerText = fileInput.files[0].name;
            // Convert image to base64 for API submission
            convertImageToBase64(fileInput.files[0]);
        }
    });
 
    // Convert image file to base64
    function convertImageToBase64(file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            uploadedImageData = e.target.result;
        };
        reader.readAsDataURL(file);
    }
 
 
    /* =====================================================
       DOB CALENDAR
    ===================================================== */
    const dobInput = document.getElementById("childDob");
    const dobIcon  = document.querySelector(".dob-icon");
 
    flatpickr(dobInput, {
    dateFormat: "d/m/Y",
    maxDate: "today",
    disableMobile: true
});
 
    if (dobIcon) {
        dobIcon.addEventListener("click", () => {
            dobInput._flatpickr.open();
        });
    }
 
 
    /* =====================================================
       AGE-WISE QUESTIONS DATA
    ===================================================== */
    const ageQuestions = {
        "0-1": {
            language: [
                "Does your baby respond to sounds or voices?",
                "Does your baby make cooing or babbling sounds?",
                "Does your baby turn their head toward familiar voices?"
            ],
            motor: [
                "Can your baby lift their head during tummy time?",
                "Can your baby roll from tummy to back or back to tummy?",
                "Can your baby sit with or without support?"
            ],
            social: [
                "Does your baby smile at people?",
                "Does your baby make eye contact?",
                "Does your baby enjoy peek-a-boo?"
            ],
            cognitive: [
                "Does your baby track moving objects?",
                "Does your baby recognize familiar faces?",
                "Does your baby explore toys using hands?"
            ]
        },
 
        "1-2": {
            language: [
                "Can your child say 2–3 words?",
                "Can your child understand simple instructions?",
                "Does your child point to things they want?"
            ],
            motor: [
                "Can your child walk independently?",
                "Can your child stack blocks?",
                "Can your child feed themselves?"
            ],
            social: [
                "Does your child play simple games?",
                "Does your child imitate actions?",
                "Does your child show affection?"
            ],
            cognitive: [
                "Does your child point to body parts?",
                "Does your child search for hidden toys?",
                "Can your child solve simple problems?"
            ]
        },
 
        "2-3": {
            language: [
                "Can your child use 2–3 word sentences?",
                "Can your child name objects?",
                "Does your child ask for things verbally?"
            ],
            motor: [
                "Can your child run and climb?",
                "Can your child kick a ball?",
                "Can your child turn book pages?"
            ],
            social: [
                "Does your child play alongside others?",
                "Does your child show interest in sharing?",
                "Does your child show preferences?"
            ],
            cognitive: [
                "Can your child sort objects?",
                "Does your child complete simple puzzles?",
                "Can your child follow 2-step instructions?"
            ]
        },
 
        "3-4": {
            language: [
                "Can your child speak in full sentences?",
                "Can your child answer simple questions?",
                "Can your child describe familiar objects?"
            ],
            motor: [
                "Can your child hop or jump?",
                "Can your child draw simple shapes?",
                "Can your child put on clothes with little help?"
            ],
            social: [
                "Does your child interact in group play?",
                "Does your child show empathy?",
                "Can your child share willingly?"
            ],
            cognitive: [
                "Does your child recognize colors?",
                "Can your child count 1–5?",
                "Does your child understand simple concepts?"
            ]
        },
 
        "4-5": {
            language: [
                "Can your child tell short stories?",
                "Can your child ask 'why' questions?",
                "Can your child speak clearly?"
            ],
            motor: [
                "Can your child hop on one foot?",
                "Can your child use scissors?",
                "Can your child dress independently?"
            ],
            social: [
                "Does your child follow rules in games?",
                "Does your child cooperate with peers?",
                "Can your child express emotions clearly?"
            ],
            cognitive: [
                "Can your child count 1–10?",
                "Does your child recognize letters?",
                "Can your child solve picture puzzles?"
            ]
        },
 
        "5-6": {
            language: [
                "Can your child speak fluently?",
                "Can your child retell a story?",
                "Can your child identify beginning sounds?"
            ],
            motor: [
                "Can your child ride a tricycle?",
                "Can your child draw a person?",
                "Can your child catch a ball?"
            ],
            social: [
                "Does your child follow group activities?",
                "Does your child show leadership?",
                "Can your child resolve small conflicts?"
            ],
            cognitive: [
                "Does your child recognize numbers?",
                "Can your child understand time concepts?",
                "Can your child complete larger puzzles?"
            ]
        },
 
        "6-7": {
            language: [
                "Can your child read simple words?",
                "Can your child write their name?",
                "Can your child explain daily routines?"
            ],
            motor: [
                "Can your child hop while balancing?",
                "Can your child tie shoelaces?",
                "Can your child coordinate both hands?"
            ],
            social: [
                "Does your child make friends easily?",
                "Does your child show leadership skills?",
                "Does your child follow school rules?"
            ],
            cognitive: [
                "Can your child solve simple math problems?",
                "Can your child follow multi-step instructions?",
                "Can your child stay focused 10–15 minutes?"
            ]
        }
    };
 
 
    /* =====================================================
       AGE GROUP (UI ONLY)
    ===================================================== */
    function getAgeGroup(dob) {
        const birth = new Date(dob);
        const today = new Date();
        let age = today.getFullYear() - birth.getFullYear();
        let m = today.getMonth() - birth.getMonth();
        if (m < 0 || (m === 0 && today.getDate() < birth.getDate())) age--;
 
        if (age <= 1) return "0-1";
        if (age <= 2) return "1-2";
        if (age <= 3) return "2-3";
        if (age <= 4) return "3-4";
        if (age <= 5) return "4-5";
        if (age <= 6) return "5-6";
        return "6-7";
    }
 
 
    /* =====================================================
       LOAD QUESTIONS + SET HIDDEN INPUTS
    ===================================================== */
    function setQ(id, text) {
        document.getElementById(id + "_text").innerText = text;
        document.getElementById(id + "_question").value = text;
    }
 
    function loadQuestions(ageGroup) {
        const q = ageQuestions[ageGroup];
        if (!q) return;
 
        q.language.forEach((t, i) => setQ(`lang_q${i+1}`, t));
        q.motor.forEach((t, i) => setQ(`motor_q${i+1}`, t));
        q.social.forEach((t, i) => setQ(`social_q${i+1}`, t));
        q.cognitive.forEach((t, i) => setQ(`cog_q${i+1}`, t));
    }
 
 
    /* =====================================================
       API INTEGRATION - SUBMIT DATA WITH FORMDATA
    ===================================================== */
    async function submitChildData() {
        try {
            showLoading(true);
            
          //  const formData = new FormData();
            
            // // Append personal details
            // formData.append('child_name', document.getElementById("childName").value);
            // formData.append('dob', document.getElementById("childDob").value);
            // formData.append('gender', document.querySelector("input[name='gender']:checked")?.value);
            // formData.append('center', document.getElementById("childCenter").value);
            // formData.append('age_group', getAgeGroup(document.getElementById("childDob").value));
            
            // // Append image file
            // if (fileInput.files[0]) {
            //     formData.append('child_image', fileInput.files[0]);
            // }
// AFTER
const formData = new FormData();
 
// Append personal details
formData.append('action', 'add_child');
// const loggedInUserId = localStorage.getItem('user_id');
const loggedInUserId = document.getElementById('sessionUserId')?.value;
formData.append('user_id', loggedInUserId);
formData.append('childName', document.getElementById("childName").value);
const rawDob = document.getElementById("childDob").value;
const [dd, mm, yyyy] = rawDob.split('/');
formData.append('dob', `${yyyy}-${mm}-${dd}`);
formData.append('gender', document.querySelector("input[name='gender']:checked")?.value);
formData.append('center', document.getElementById("childCenter").value);
formData.append('age_group', getAgeGroup(document.getElementById("childDob").value));
 
// Append image file
if (fileInput.files[0]) {
    formData.append('childImage', fileInput.files[0]);
}
            // Append assessment answers
            for (let i = 1; i <= 3; i++) {
                formData.append(`lang_q${i}_question`, document.getElementById(`lang_q${i}_question`).value);
                formData.append(`lang_q${i}`, document.querySelector(`input[name='lang_q${i}']:checked`)?.value || '');
                
                formData.append(`motor_q${i}_question`, document.getElementById(`motor_q${i}_question`).value);
                formData.append(`motor_q${i}`, document.querySelector(`input[name='motor_q${i}']:checked`)?.value || '');
                
                formData.append(`social_q${i}_question`, document.getElementById(`social_q${i}_question`).value);
                formData.append(`social_q${i}`, document.querySelector(`input[name='social_q${i}']:checked`)?.value || '');
                
                formData.append(`cog_q${i}_question`, document.getElementById(`cog_q${i}_question`).value);
                formData.append(`cog_q${i}`, document.querySelector(`input[name='cog_q${i}']:checked`)?.value || '');
            }
 
            // Make API call (NO TOKEN REQUIRED)
            // const response = await fetch(`${API_CONFIG.baseURL}${API_CONFIG.endpoints.addChild}`, {
            //     method: 'POST',
            //     body: formData
            //     // NO headers needed for FormData - browser sets them automatically
            // });
// const response = await fetch("http://localhost/spacece-main/milestone/api_proxy.php", {
//     method: 'POST',
//     body: formData
// });
 
// ✅ Call API directly — no proxy needed
formData.delete('action'); // remove action field, not needed directly
const response = await fetch("http://localhost/spacece-main/api/AddNewChild_MilesStone.php", {
    method: 'POST',
    body: formData
});
            // const result = await response.json();
            const text = await response.text();
console.log("RAW RESPONSE:", text);
 
let result;
try {
    result = JSON.parse(text);
} catch (e) {
    console.error("NOT JSON ERROR ❌:", text);
    throw new Error("Server returned invalid JSON");
}
            showLoading(false);
 
            // ── Guard: proxy returned HTML instead of real API JSON ──
            // This happens when the remote hosting account is suspended
            // or the backend is unreachable (proxy wraps the HTML in JSON).
            if (result.raw_response || result.message === 'Backend did not return JSON') {
                // Try to give a human-readable reason from the HTML page
                const isSuspended = result.raw_response && result.raw_response.includes('Account Suspended');
                const reason = isSuspended
                    ? 'The remote server account is currently suspended. Please contact your hosting provider (MilesWeb) to reactivate it.'
                    : 'The server did not return a valid response. Please try again later.';
                throw new Error(reason);
            }
 
            // ── Normal success / failure from the real API ──
          // ✅ Also accepts 201 (Created)
if (result.success === true || result.status === 200 || result.status === 201) {
                return {
                    success: true,
                    data: result
                };
            } else {
                throw new Error(result.error || result.message || 'Submission failed');
            }
 
        } catch (error) {
            showLoading(false);
            console.error('API Error:', error);
            return {
                success: false,
                error: error.message || 'Failed to fetch'
            };
        }
    }
 
 
    /* =====================================================
       API INTEGRATION - LOADING STATE
    ===================================================== */
    function showLoading(show) {
        const submitBtn = document.querySelector(".submit-btn");
        if (show) {
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span>Submitting...</span>';
            submitBtn.style.opacity = '0.6';
        } else {
            submitBtn.disabled = false;
            submitBtn.innerHTML = 'Submit';
            submitBtn.style.opacity = '1';
        }
    }
 
 
    /* =====================================================
       API INTEGRATION - RESPONSE HANDLER
    ===================================================== */
    function handleAPIResponse(response) {
        if (response.success) {
            // Success alert
            showSuccessAlert();
            console.log('✅ Success! Response data:', response.data);
            
            // Ask to add another child after 2 seconds
            setTimeout(() => {
                if (confirm('Child data submitted successfully!')) {
                  //  window.location.href = "./milestone/Parent_Dashboard.php";
                window.location.href = "Parent_Dashboard.php";
                } else {
                    resetForm();
 
                }
            }, 2000);
            
        } else {
            // Error alert
            showErrorAlert(response.error);
            console.error('❌ Submission failed:', response.error);
        }
    }
 
 
    /* =====================================================
       SUCCESS ALERT
    ===================================================== */
    function showSuccessAlert() {
        const alertHTML = `
            <div id="successAlert" style="
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                color: white;
                padding: 30px 40px;
                border-radius: 15px;
                box-shadow: 0 10px 40px rgba(0,0,0,0.3);
                z-index: 10000;
                text-align: center;
                min-width: 300px;
                animation: slideIn 0.5s ease-out;
            ">
                <div style="font-size: 50px; margin-bottom: 15px;">✓</div>
                <h2 style="margin: 0 0 10px 0; font-size: 24px; font-weight: 700;">Success!</h2>
                <p style="margin: 0; font-size: 16px; opacity: 0.95;">Child data has been submitted successfully!</p>
            </div>
            <div id="alertOverlay" style="
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0,0,0,0.5);
                z-index: 9999;
                animation: fadeIn 0.3s ease-out;
            "></div>
            <style>
                @keyframes slideIn {
                    from {
                        transform: translate(-50%, -60%);
                        opacity: 0;
                    }
                    to {
                        transform: translate(-50%, -50%);
                        opacity: 1;
                    }
                }
                @keyframes fadeIn {
                    from { opacity: 0; }
                    to { opacity: 1; }
                }
            </style>
        `;
        
        document.body.insertAdjacentHTML('beforeend', alertHTML);
        
        // Auto-remove after 3 seconds
        setTimeout(() => {
            const alert = document.getElementById('successAlert');
            const overlay = document.getElementById('alertOverlay');
            if (alert) alert.remove();
            if (overlay) overlay.remove();
        }, 3000);
    }
 
 
    /* =====================================================
       ERROR ALERT
    ===================================================== */
    function showErrorAlert(errorMessage) {
        const alertHTML = `
            <div id="errorAlert" style="
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
                color: white;
                padding: 30px 40px;
                border-radius: 15px;
                box-shadow: 0 10px 40px rgba(0,0,0,0.3);
                z-index: 10000;
                text-align: center;
                min-width: 300px;
                max-width: 400px;
                animation: slideIn 0.5s ease-out;
            ">
                <div style="font-size: 50px; margin-bottom: 15px;">✕</div>
                <h2 style="margin: 0 0 10px 0; font-size: 24px; font-weight: 700;">Error!</h2>
                <p style="margin: 0; font-size: 16px; opacity: 0.95; word-wrap: break-word;">${errorMessage || 'Failed to submit. Please check your API connection.'}</p>
            </div>
            <div id="alertOverlay" style="
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0,0,0,0.5);
                z-index: 9999;
                animation: fadeIn 0.3s ease-out;
            " onclick="this.remove(); document.getElementById('errorAlert').remove();"></div>
            <style>
                @keyframes slideIn {
                    from {
                        transform: translate(-50%, -60%);
                        opacity: 0;
                    }
                    to {
                        transform: translate(-50%, -50%);
                        opacity: 1;
                    }
                }
                @keyframes fadeIn {
                    from { opacity: 0; }
                    to { opacity: 1; }
                }
            </style>
        `;
        
        document.body.insertAdjacentHTML('beforeend', alertHTML);
        
        // Auto-remove after 5 seconds
        setTimeout(() => {
            const alert = document.getElementById('errorAlert');
            const overlay = document.getElementById('alertOverlay');
            if (alert) alert.remove();
            if (overlay) overlay.remove();
        }, 5000);
    }
 
 
    /* =====================================================
       RESET FORM
    ===================================================== */
    function resetForm() {
        // Reset the form
        document.getElementById("childForm").reset();
        
        // Reset file input display
        fileName.innerText = "Upload child's picture";
        uploadedImageData = null;
        
        // Reset to step 1
        currentStep = 1;
        showStep(currentStep);
        
        // Clear all radio selections
        document.querySelectorAll('input[type="radio"]').forEach(radio => radio.checked = false);
    }
 
 
    /* =====================================================
       STEP SYSTEM
    ===================================================== */
    let currentStep = 1;
    const totalSteps = 5;
 
    const steps = document.querySelectorAll(".form-step");
    const nextBtn = document.querySelector(".next-btn");
    const prevBtn = document.querySelector(".prev-btn");
    const submitBtn = document.querySelector(".submit-btn");
    const progressFill = document.querySelector(".progress-fill");
    const stepCounter = document.querySelector(".step");
 
    function showStep(step) {
        steps.forEach((s, i) => s.style.display = i + 1 === step ? "block" : "none");
        progressFill.style.width = (step / totalSteps) * 100 + "%";
        stepCounter.innerText = `${step} of ${totalSteps}`;
        prevBtn.style.display = step === 1 ? "none" : "inline-block";
        nextBtn.style.display = step === totalSteps ? "none" : "inline-block";
        submitBtn.style.display = step === totalSteps ? "block" : "none";
    }
 
    showStep(currentStep);
 
 
    /* =====================================================
       VALIDATION
    ===================================================== */
    function validateStep(step) {
        if (step === 1) {
            if (!fileInput.value) return alert("Upload image"), false;
            if (!childName.value.trim()) return alert("Enter child name"), false;
            if (!childDob.value) return alert("Select DOB"), false;
            if (!document.querySelector("input[name='gender']:checked")) return alert("Select gender"), false;
            if (!childCenter.value) return alert("Select center"), false;
        }
        
        if (step === 2) {
            for (let i = 1; i <= 3; i++) {
                if (!document.querySelector(`input[name='lang_q${i}']:checked`)) {
                    return alert(`Please answer language question ${i}`), false;
                }
            }
        }
        
        if (step === 3) {
            for (let i = 1; i <= 3; i++) {
                if (!document.querySelector(`input[name='motor_q${i}']:checked`)) {
                    return alert(`Please answer motor question ${i}`), false;
                }
            }
        }
        
        if (step === 4) {
            for (let i = 1; i <= 3; i++) {
                if (!document.querySelector(`input[name='social_q${i}']:checked`)) {
                    return alert(`Please answer social question ${i}`), false;
                }
            }
        }
        
        if (step === 5) {
            for (let i = 1; i <= 3; i++) {
                if (!document.querySelector(`input[name='cog_q${i}']:checked`)) {
                    return alert(`Please answer cognitive question ${i}`), false;
                }
            }
        }
        
        return true;
    }
 
 
    /* =====================================================
       NEXT / PREVIOUS / SUBMIT
    ===================================================== */
    nextBtn.addEventListener("click", () => {
        if (!validateStep(currentStep)) return;
 
        if (currentStep === 1) {
            loadQuestions(getAgeGroup(childDob.value));
        }
 
        currentStep++;
        showStep(currentStep);
    });
 
    prevBtn.addEventListener("click", () => {
        currentStep--;
        showStep(currentStep);
    });
 
    // SUBMIT WITH API INTEGRATION (NO TOKEN REQUIRED)
    submitBtn.addEventListener("click", async (e) => {
        e.preventDefault();
        
        console.log('📤 Starting submission...');
        console.log('📍 API URL:', `${API_CONFIG.baseURL}${API_CONFIG.endpoints.addChild}`);
        
        if (!validateStep(currentStep)) return;
        
        // Submit to API
        const response = await submitChildData();
        
        // Handle the response
        handleAPIResponse(response);
    });
 
});