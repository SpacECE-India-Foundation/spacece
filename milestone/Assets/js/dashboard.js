const Store = {
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
 
// ─────────────────────────────────────────────
// 1.  CONFIG
// ─────────────────────────────────────────────
// FIX 1: was 'https://localhost/spacece-main//api' — https causes ERR_CERT_AUTHORITY_INVALID
//         on localhost; double slash was also malformed.
const REMOTE_API = window.location.hostname === 'localhost'
  ? 'http://localhost/spacece-main/milestone/api_proxy.php'
  : 'https://hustle-7c68d043.mileswebhosting.com/spacece/api';
 
// function apiUrl(file) {
//   return `${REMOTE_API}/${file}`;
// }
 
// ─────────────────────────────────────────────
// 2.  READ USER / CHILD FROM STORAGE
// ─────────────────────────────────────────────
let userId  = null;
let childId = null;
 
if (!userId) {
  try {
    const raw = Store.get('user') || Store.get('userData');
    if (raw) {
      const obj = JSON.parse(raw);
      userId  = obj.id   || obj.user_id  || obj.userId;
      childId = obj.childId || obj.child_id;
    }
  } catch (_) {}
}
 
if (userId)  Store.set('userId',  userId);
if (childId) Store.set('childId', childId);
 
// ─────────────────────────────────────────────
// 3.  LOAD CHILDREN (child selector row)
// ─────────────────────────────────────────────
async function loadChildren() {
  if (!userId) {
    console.warn('[Dashboard] userId not found in storage – child list will not load.');
    const el = document.getElementById('childNameAge');
    if (el) el.innerHTML = '<p style="color:#888">Please log in to view your children.</p>';
    return;
  }
 
  try {
    // const res  = await fetch(`${apiUrl('Parent_GetChildren.php')}?userId=${userId}`);
    const res = await fetch(`/spacece-main/milestone/api_proxy.php?action=get_children&userId=${userId}`);
    const json = await res.json();
 
    if (json.status !== 200 || !json.data?.children?.length) {
      console.warn('[Dashboard] No children found or API error:', json.message);
      return;
    }
 
    const children = json.data.children;
 
    const switchEl = document.getElementById('childSwitch');
    if (switchEl) {
      switchEl.querySelectorAll('.child-icon-btn').forEach(el => el.remove());
 
      children.forEach(child => {
       // const imgFile = child.image ? child.image.split('/').pop() : null;
      //  const imagePath = child.image || null; 
      //  const isLocal = window.location.hostname === 'localhost';
 
      //   // FIX 2: 'btn' was used before being declared — added missing declaration
      //   const btn = document.createElement('img');
      //   btn.className = 'child-icon-btn';
      //   btn.src = imgFile
      //     ? isLocal
      //       // ? `/spacece-main/milestone/uploads/children/${imgFile}` 
      //       ? `/spacece-main/uploads/children/${imgFile}`
      //       : `${REMOTE_API.replace('/api', '')}/uploads/children/${imgFile}`
      //     : '/spacece-main/milestone/Assets/img/default_child.png';
      const imagePath = child.image || null;

const btn = document.createElement('img');
btn.className = 'child-icon-btn';

// 🔥 FIX: use imagePath directly (API already gives correct path)
btn.src = imagePath
  ? imagePath.replace('/milestone', '')
  : '/spacece-main/milestone/Assets/img/default_child.png';
        btn.alt        = child.child_name;
        btn.title      = child.child_name;
        btn.style.cssText = 'width:60px;height:60px;border-radius:50%;object-fit:cover;border:3px solid #fff;box-shadow:0 6px 18px rgba(0,0,0,.2);cursor:pointer;';
        btn.addEventListener('click', () => selectChild(child));
        switchEl.insertBefore(btn, switchEl.querySelector('.add-child'));
      });
    }
 
    const saved = children.find(c => String(c.id) === String(childId)) || children[0];
    selectChild(saved);
 
  } catch (err) {
    console.error('[Dashboard] loadChildren failed:', err);
  }
}
 
// ─────────────────────────────────────────────
// 4.  SELECT CHILD  → update profile area
// ─────────────────────────────────────────────
function selectChild(child) {
  if (!child) return;
 
  childId = child.id;
  Store.set('childId', childId);
 
  const nameAgeEl = document.getElementById('childNameAge');
  if (nameAgeEl) {
    const dob   = child.dob ? new Date(child.dob) : null;
    const age   = dob ? Math.floor((Date.now() - dob) / (365.25 * 24 * 3600 * 1000)) : '?';
    nameAgeEl.innerHTML = `<strong>${child.child_name || '–'}</strong> | <span class="highlight">${age} Years</span>`;
  }
 
  const centerEl = document.getElementById('childCenter');
  if (centerEl) {
    centerEl.innerHTML = `Center: <span class="highlight">${child.center || '–'}</span>`;
  }
 
  loadMilestoneCount(child.id);
 if (typeof loadTable === 'function') loadTable(1);
  document.dispatchEvent(new CustomEvent('childSelected', { detail: { childId: child.id } }));
}
 
// ─────────────────────────────────────────────
// 5.  MILESTONE COUNT
// ─────────────────────────────────────────────
async function loadMilestoneCount(cId) {
  const countEl = document.getElementById('milestoneCount');
  if (!countEl || !userId || !cId) return;
 
  try {
    // const res  = await fetch(`${apiUrl('Get_MilesStoneTask.php')}?userId=${userId}&childId=${cId}`);
    const res = await fetch(`/spacece-main/milestone/api_proxy.php?action=get_tasks&userId=${userId}&childId=${cId}`);
    const json = await res.json();
 
    if (json.status === 200 && json.data) {
      const m = json.data.milestones || '0/0';
      countEl.textContent = m;
    }
  } catch (err) {
    console.error('[Dashboard] loadMilestoneCount failed:', err);
  }
}
 
// ─────────────────────────────────────────────
// 6.  BOOT
// ─────────────────────────────────────────────
document.addEventListener('DOMContentLoaded', () => {
  userId  = document.getElementById('sessionUserId')?.value
            || Store.get('userId')
            || Store.get('user_id');
 
  // childId = document.getElementById('sessionChildId')?.value
  //           || Store.get('childId')
  //           || Store.get('child_id');
 childId = document.getElementById('sessionChildId')?.value;
if (!childId || childId === '0') {
  childId = Store.get('childId') || Store.get('child_id') || null;
}

  console.log("SESSION USER ID:", userId);
  console.log("SESSION CHILD ID:", childId);
 
  if (!userId || userId === "0") {
    console.error("❌ User not logged in or session missing");
    return;
  }
 
  Store.set('userId', userId);
  if (childId) Store.set('childId', childId);
 
  loadChildren();
});
 
// ─────────────────────────────────────────────
// 7.  SUBMIT PHYSICAL DATA (height / weight)
// ─────────────────────────────────────────────
async function submitPhysicalData() {
  const height = document.getElementById('heightInput')?.value?.trim();
  const weight = document.getElementById('weightInput')?.value?.trim();
 
  if (!height || !weight) {
    alert('Please enter both height and weight.');
    return;
  }
  if (!userId || !childId || childId === '0') {
    alert('No child selected.');
    return;
  }
 
  const fd = new FormData();
  fd.append('height', height);
  fd.append('weight', weight);
 
  try {
   const res = await fetch(`/spacece-main/milestone/api_proxy.php?action=update_growth&userId=${userId}&childId=${childId}`, { method: 'POST', body: fd });
    
    const json = await res.json();
 
    if (json.status === 200) {
      alert('Growth data updated successfully!');
      document.getElementById('heightInput').value = '';
      document.getElementById('weightInput').value = '';
    } else {
      alert('Error: ' + (json.message || 'Unknown error'));
    }
  } catch (err) {
    console.error('[Dashboard] submitPhysicalData failed:', err);
    alert('Network error. Please try again.');
  }
}
async function loadDevelopmentProgress(cId) {
  try {
    const res = await fetch(`/spacece-main/milestone/api_proxy.php?action=get_tasks&userId=${userId}&childId=${cId}`);
    const json = await res.json();
    if (json.status !== 200 || !json.data) return;

    const acts = json.data.activities || '0/0';
    const mils = json.data.milestones || '0/0';

    const [aDone, aTotal] = acts.split('/').map(Number);
    const score = aTotal > 0 ? Math.round((aDone / aTotal) * 100) : 0;

    document.querySelectorAll('.progress-card').forEach(card => {
      const circle = card.querySelector('.circle');
      const span   = card.querySelector('.circle span');
      if (span) span.textContent = score + '%';
      if (circle) circle.style.background =
        `conic-gradient(#ff9800 ${score * 3.6}deg, #eee 0deg)`;
    });
  } catch(e) {
    console.error('[Progress] failed:', e);
  }
}