/* ======================================
   GET childId FROM LOCAL STORAGE
====================================== */
let childId = localStorage.getItem("child_id");

let heightChart;
let weightChart;


/* ======================================
   LOAD GROWTH DATA FROM API
====================================== */
async function loadGrowthData() {
    if (!childId) {
        console.error("❌ childId not found in localStorage");
        return;
    }

    try {
        console.log("Fetching Growth Data for Child:", childId);

        const res = await fetch(`${BASE_URL}/api_get_child.php?childId=${childId}`);
        const json = await res.json();

        console.log("Growth API Response:", json);

        if (!json.status || !json.data) {
            console.warn("⚠ No growth data found for child.");
            return;
        }

        const heightData = json.data.heightHistory || [];
        const weightData = json.data.weightHistory || [];

        drawHeightChart(heightData);
        drawWeightChart(weightData);

    } catch (err) {
        console.error("❌ Growth Load Error:", err);
    }
}


/* ======================================
   HEIGHT CHART BUILDER
====================================== */
function drawHeightChart(data) {
    const labels = data.map(item => item.month);    // e.g. ["Apr","May","Jun"]
    const values = data.map(item => item.height);   // e.g. [80, 82, 85]

    const ctx = document.getElementById("heightChart").getContext("2d");

    if (heightChart) heightChart.destroy();

    heightChart = new Chart(ctx, {
        type: "line",
        data: {
            labels,
            datasets: [{
                label: "Height (cm)",
                data: values,
                borderColor: "#ff9800",
                backgroundColor: "#ff9800",
                pointBackgroundColor: "#ff9800",
                borderWidth: 3,
                tension: 0.4,
                pointRadius: 6,
            }]
        },
        options: {
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: false } }
        }
    });
}


/* ======================================
   WEIGHT CHART BUILDER
====================================== */
function drawWeightChart(data) {
    const labels = data.map(item => item.month);
    const values = data.map(item => item.weight);

    const ctx = document.getElementById("weightChart").getContext("2d");

    if (weightChart) weightChart.destroy();

    weightChart = new Chart(ctx, {
        type: "line",
        data: {
            labels,
            datasets: [{
                label: "Weight (kg)",
                data: values,
                borderColor: "#f57c00",
                backgroundColor: "#f57c00",
                pointBackgroundColor: "#f57c00",
                borderWidth: 3,
                tension: 0.4,
                pointRadius: 6,
            }]
        },
        options: {
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: false } }
        }
    });
}


/* ======================================
   AUTO UPDATE WHEN CHILD IS SWITCHED
====================================== */
document.addEventListener("child_switched", () => {
    childId = localStorage.getItem("child_id");
    loadGrowthData();
});


/* INITIAL LOAD */
loadGrowthData();
