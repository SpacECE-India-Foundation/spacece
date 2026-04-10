/**
 * milestone.js  –  Milestone Tracker page
 *
 * FIXES:
 * 1. Safe storage (no localStorage crash / Tracking-Prevention error)
 * 2. All API calls use the correct remote URL (no CORS — same server)
 * 3. "childId not found" guard with clear UI message
 * 4. Video upload uses correct SubmitMilesStone_Task.php endpoint
 */
 
// ─────────────────────────────────────────────
// Safe Storage
// ─────────────────────────────────────────────
const MStore = {
  get(key) {
    try { const v = sessionStorage.getItem(key); if (v !== null) return v; } catch (_) {}
    try { return localStorage.getItem(key); } catch (_) {}
    return null;
  },
  set(key, value) {
    try { sessionStorage.setItem(key, value); } catch (_) {}
    try { localStorage.setItem(key, value); } catch (_) {}
  }
};
 
const MS_API = 'https://hustle-7c68d043.mileswebhosting.com/spacece/api';
const MS_PROXY = '/spacece-main/milestone/api_proxy.php';
 
// ─────────────────────────────────────────────
// State
// ─────────────────────────────────────────────
let msUserId  = null;
let msChildId = null;
let pendingTaskId = null;   // for video upload modal
 
// ─────────────────────────────────────────────
// Init
// ─────────────────────────────────────────────
document.addEventListener('DOMContentLoaded', async () => {
  msUserId  = MStore.get('userId')  || MStore.get('user_id');
  msChildId = MStore.get('childId') || MStore.get('child_id');
 
  // Try parsing stored user object if needed
  if (!msUserId) {
    try {
      const raw = MStore.get('user') || MStore.get('userData');
      if (raw) {
        const obj = JSON.parse(raw);
        msUserId  = obj.id || obj.user_id || obj.userId;
        msChildId = obj.childId || obj.child_id;
      }
    } catch (_) {}
  }
 
  if (!msUserId) {
    showError('Please log in to view milestones.');
    return;
  }
 
  await loadChildButtons();
});
 
// ─────────────────────────────────────────────
// Load child selector buttons
// ─────────────────────────────────────────────
async function loadChildButtons() {
  try {
    const res  = await fetch(`${MS_PROXY}?action=get_children&userId=${msUserId}`);
    const json = await res.json();
 
    const buttonsEl = document.getElementById('childButtons');
    if (!buttonsEl) return;
 
    if (json.status !== 200 || !json.data?.children?.length) {
      buttonsEl.innerHTML = '<p style="color:#888">No children found. Please add a child first.</p>';
      return;
    }
 
    buttonsEl.innerHTML = '';
    json.data.children.forEach(child => {
      const btn = document.createElement('button');
      btn.className    = 'child-btn';
      btn.textContent  = child.child_name;
      btn.dataset.id   = child.id;
      btn.addEventListener('click', () => {
        document.querySelectorAll('.child-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        msChildId = child.id;
        MStore.set('childId', msChildId);
        loadMilestoneTasks(msChildId);
      });
      buttonsEl.appendChild(btn);
    });
 
    // Auto-select saved child or first
    const savedBtn = buttonsEl.querySelector(`[data-id="${msChildId}"]`) || buttonsEl.querySelector('.child-btn');
    if (savedBtn) {
      savedBtn.click();
    }
 
  } catch (err) {
    console.error('[Milestone] loadChildButtons error:', err);
    showError('Failed to load children. Please refresh.');
  }
}
 
// ─────────────────────────────────────────────
// Load milestone tasks for selected child
// ─────────────────────────────────────────────
async function loadMilestoneTasks(childId) {
  const tasksEl        = document.getElementById('milestoneTasks');
  const totalMsEl      = document.getElementById('totalMilestones');
  const completedEl    = document.getElementById('completedTasks');
  const circleEl       = document.getElementById('completionCircle');
 
  if (!tasksEl) return;
  tasksEl.innerHTML = '<p style="color:#aaa;text-align:center;padding:20px;">Loading…</p>';
 
  try {
    const res  = await fetch(`${MS_PROXY}?action=get_tasks&userId=${msUserId}&childId=${childId}`);
    const json = await res.json();
 
    if (json.status !== 200) {
      tasksEl.innerHTML = `<p style="color:#e55;text-align:center;">${json.message || 'Error loading tasks.'}</p>`;
      return;
    }
 
    const data  = json.data;
    const tasks = data.tasks || [];
 
    // Update summary counters
    const [mDone, mTotal] = (data.milestones || '0/0').split('/').map(Number);
    const [aDone, aTotal] = (data.activities || '0/0').split('/').map(Number);
 
    if (totalMsEl)   totalMsEl.textContent   = mTotal;
    if (completedEl) completedEl.textContent  = mDone + aDone;
    if (circleEl)    circleEl.textContent     = `${mDone}/${mTotal}`;
 
    // Render tasks
    tasksEl.innerHTML = '';
 
    if (!tasks.length) {
      tasksEl.innerHTML = '<p style="color:#aaa;text-align:center;padding:20px;">No tasks for today.</p>';
      return;
    }
 
    tasks.forEach(task => {
      if (task.type === 'milestone') {
        tasksEl.appendChild(renderMilestone(task));
      } else {
        tasksEl.appendChild(renderActivity(task));
      }
    });
 
  } catch (err) {
    console.error('[Milestone] loadMilestoneTasks error:', err);
    tasksEl.innerHTML = '<p style="color:#e55;text-align:center;">Network error. Please try again.</p>';
  }
}
 
// ─────────────────────────────────────────────
// Render helpers
// ─────────────────────────────────────────────
function renderActivity(task) {
  const div = document.createElement('div');
  div.className = `task${task.isCompleted ? ' completed' : ''}`;
  div.innerHTML = `
    <div class="task-info">
      <p>${task.task}</p>
      <span class="tag ${(task.category || '').toLowerCase()}">${task.category || 'Activity'}</span>
    </div>
    <div class="check ${task.isCompleted ? 'active' : ''}" data-id="${task.taskId}" onclick="toggleActivity(this)">
      ${task.isCompleted ? '✓' : ''}
    </div>`;
  return div;
}
 
function renderMilestone(task) {
  const wrap = document.createElement('div');
  wrap.className = 'milestone';
  wrap.innerHTML = `
    <div class="milestone-title">🎯 Milestone</div>
    <div class="milestone-box">
      <div class="task-info">
        <p>${task.task}</p>
        <span class="tag">${task.category || 'Milestone'}</span>
      </div>
      ${task.isCompleted
        ? '<span class="video-badge">✓ Completed</span>'
        : `<div class="upload" title="Upload video proof" onclick="openVideoModal(${task.taskId})">
             📹
             <input type="file" accept="video/*" style="display:none">
           </div>`
      }
    </div>`;
  return wrap;
}
 
// ─────────────────────────────────────────────
// Toggle activity completion
// ─────────────────────────────────────────────
async function toggleActivity(el) {
  const taskId    = el.dataset.id;
  const completed = !el.classList.contains('active');
 
  try {
    const fd3 = new FormData();
    fd3.append('action', 'update_task');
    fd3.append('userId', msUserId);
    fd3.append('childId', msChildId);
    fd3.append('taskId', parseInt(taskId));
    fd3.append('completed', completed ? '1' : '0');
    const res  = await fetch(MS_PROXY, { method: 'POST', body: fd3 });
    const json = await res.json();
 
    if (json.status === 200) {
      el.classList.toggle('active', completed);
      el.textContent = completed ? '✓' : '';
      el.closest('.task')?.classList.toggle('completed', completed);
      // Reload counts
      loadMilestoneTasks(msChildId);
    } else {
      alert(json.message || 'Could not update task.');
    }
  } catch (err) {
    console.error('[Milestone] toggleActivity error:', err);
    alert('Network error. Please try again.');
  }
}
 
// ─────────────────────────────────────────────
// Video upload modal
// ─────────────────────────────────────────────
function openVideoModal(taskId) {
  pendingTaskId = taskId;
  const modal = document.getElementById('videoModal');
  if (modal) modal.style.display = 'flex';
}
 
function closeModal() {
  const modal = document.getElementById('videoModal');
  if (modal) modal.style.display = 'none';
  pendingTaskId = null;
  const input = document.getElementById('taskVideo');
  if (input) input.value = '';
}
 
async function uploadVideo() {
  const input = document.getElementById('taskVideo');
  if (!input?.files?.length) { alert('Please select a video file.'); return; }
 
  if (!pendingTaskId || !msUserId || !msChildId) {
    alert('Missing required data. Please refresh and try again.');
    return;
  }
 
  const fd = new FormData();
  fd.append('userId',    msUserId);
  fd.append('childId',   msChildId);
  fd.append('taskId',    pendingTaskId);
  fd.append('taskVideo', input.files[0]);
 
  try {
    fd.append('action', 'submit_milestone');
  const res  = await fetch(MS_PROXY, { method: 'POST', body: fd });
    const json = await res.json();
 
    if (json.status === 200) {
      alert('Milestone video uploaded successfully!');
      closeModal();
      loadMilestoneTasks(msChildId);
    } else {
      alert('Upload failed: ' + (json.message || 'Unknown error'));
    }
  } catch (err) {
    console.error('[Milestone] uploadVideo error:', err);
    alert('Network error. Please try again.');
  }
}
 
// ─────────────────────────────────────────────
// Utility
// ─────────────────────────────────────────────
function showError(msg) {
  const areas = ['childButtons', 'milestoneTasks'];
  areas.forEach(id => {
    const el = document.getElementById(id);
    if (el) el.innerHTML = `<p style="color:#e55;padding:10px;">${msg}</p>`;
  });
}