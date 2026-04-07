/**
 * growth.js  –  Height & Weight Chart (Chart.js)
 *
 * FIXES:
 * 1. Uses same safe Store helper as dashboard.js (no direct localStorage crash)
 * 2. API calls are relative / go through the correct remote path
 * 3. Graceful empty-state if no growth data yet
 */
 
// ─────────────────────────────────────────────
// Safe storage (same pattern as dashboard.js)
// ─────────────────────────────────────────────
const GrowthStore = {
  get(key) {
    try { const v = sessionStorage.getItem(key); if (v !== null) return v; } catch (_) {}
    try { return localStorage.getItem(key); } catch (_) {}
    return null;
  }
};
 
// const GROWTH_API = 'https://hustle-7c68d043.mileswebhosting.com/spacece/api';
const GROWTH_PROXY = '/spacece-main/milestone/api_proxy.php';
 
let heightChart = null;
let weightChart = null;
 
function buildChart(canvasId, label, color, labels, values) {
  const canvas = document.getElementById(canvasId);
  if (!canvas) return;
 
  // Destroy previous instance if re-rendering
  if (canvasId === 'heightChart' && heightChart) { heightChart.destroy(); }
  if (canvasId === 'weightChart' && weightChart) { weightChart.destroy(); }
 
  const chart = new Chart(canvas, {
    type: 'line',
    data: {
      labels,
      datasets: [{
        label,
        data: values,
        borderColor: color,
        backgroundColor: color + '22',
        pointBackgroundColor: color,
        pointRadius: 5,
        tension: 0.4,
        fill: true
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: { display: true },
        tooltip: { mode: 'index', intersect: false }
      },
      scales: {
        y: { beginAtZero: false }
      }
    }
  });
 
  if (canvasId === 'heightChart') heightChart = chart;
  else weightChart = chart;
}
 
async function loadGrowthData() {
  const userId  = GrowthStore.get('userId')  || GrowthStore.get('user_id');
  const childId = GrowthStore.get('childId') || GrowthStore.get('child_id');
 
  if (!userId || !childId) {
    console.warn('[Growth] userId or childId missing from storage');
    // Render empty placeholder charts so the UI doesn't look broken
    buildChart('heightChart', 'Height (cm)', '#f6a623', ['No data'], [0]);
    buildChart('weightChart', 'Weight (kg)', '#4caf50', ['No data'], [0]);
    return;
  }
 
  try {
    //const res  = await fetch(`${GROWTH_API}/Get_ChildGrowth.php?userId=${userId}&childId=${childId}`);
    const res = await fetch(`${GROWTH_PROXY}?action=get_growth&userId=${userId}&childId=${childId}`);
    const json = await res.json();
 
    if (json.status !== 200 || !json.data?.growth?.length) {
      console.warn('[Growth] No growth data:', json.message);
      buildChart('heightChart', 'Height (cm)', '#f6a623', ['No data'], [0]);
      buildChart('weightChart', 'Weight (kg)', '#4caf50', ['No data'], [0]);
      return;
    }
 
    const records = json.data.growth;
    const labels  = records.map(r => {
      const d = new Date(r.measured_at || r.date);
      return `${d.getDate()}/${d.getMonth()+1}/${d.getFullYear()}`;
    });
    const heights = records.map(r => parseFloat(r.height));
    const weights = records.map(r => parseFloat(r.weight));
 
    buildChart('heightChart', 'Height (cm)', '#f6a623', labels, heights);
    buildChart('weightChart', 'Weight (kg)', '#4caf50', labels, weights);
 
  } catch (err) {
    console.error('[Growth] loadGrowthData failed:', err);
    buildChart('heightChart', 'Height (cm)', '#f6a623', ['Error'], [0]);
    buildChart('weightChart', 'Weight (kg)', '#4caf50', ['Error'], [0]);
  }
}
 
//document.addEventListener('DOMContentLoaded', loadGrowthData);
 
// Re-render charts when a new child is selected (dashboard.js dispatches this event)
document.addEventListener('childSelected', () => loadGrowthData());