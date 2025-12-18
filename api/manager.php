<?php
// Mock Data
$announcements = [
    ['id' => 1, 'title' => 'Welcome Week Schedule', 'date' => 'Oct 12, 2025', 'status' => 'Published'],
    ['id' => 2, 'title' => 'Club Fair Sign-ups', 'date' => 'Oct 15, 2025', 'status' => 'Draft']
];

$members = [
    ['id' => 101, 'name' => 'Sarah Jenkins', 'role' => 'Student', 'status' => 'Pending'],
    ['id' => 102, 'name' => 'Michael Chen', 'role' => 'Student', 'status' => 'Pending'],
    ['id' => 103, 'name' => 'Amara Okafor', 'role' => 'Faculty', 'status' => 'Pending']
];

$events = [
    ['id' => 501, 'name' => 'Intro to Robotics Workshop', 'date' => 'Nov 01, 2025', 'location' => 'Lab 3B'],
    ['id' => 502, 'name' => 'Guest Speaker: AI Ethics', 'date' => 'Nov 10, 2025', 'location' => 'Main Hall']
];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager Dashboard | After9</title>
    <link rel="stylesheet" href="/manager.css">
</head>

<body>

    <header>
        <div class="logo">After9 <span
                style="font-size: 0.8rem; opacity: 0.8; font-family: 'Plus Jakarta Sans', sans-serif;">MANAGER</span>
        </div>
        <nav>
            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="#" class="active">Dashboard</a></li>
                <li>
                    <div class="user-profile"></div>
                </li>
            </ul>
        </nav>
    </header>

    <div class="manager-container">
        <!-- Sidebar -->
        <aside class="manager-sidebar">
            <div class="manager-nav-item active" onclick="switchTab('announcements')">Announcements</div>
            <div class="manager-nav-item" onclick="switchTab('members')">Waiting List <span
                    style="background: var(--primary-green); color: white; padding: 2px 6px; border-radius: 10px; font-size: 0.7rem; margin-left: 5px;"><?php echo count($members); ?></span>
            </div>
            <div class="manager-nav-item" onclick="switchTab('events')">Events</div>
            <div
                style="margin-top: 2rem; padding-top: 1rem; border-top: 1px solid rgba(0,0,0,0.1); cursor: pointer; color: #e63946; font-size: 0.9rem;">
                Log Out</div>
        </aside>

        <!-- Main Content -->
        <main>

            <!-- Announcements Section -->
            <section id="announcements" class="dashboard-section active">
                <div class="manager-header">
                    <h2>Announcements</h2>
                    <button class="action-btn btn-primary">+ New Post</button>
                </div>

                <div class="list-container">
                    <?php foreach ($announcements as $item): ?>
                        <div class="item-card">
                            <div class="item-info">
                                <h3><?php echo $item['title']; ?></h3>
                                <div class="item-meta">Posted: <?php echo $item['date']; ?> • <span
                                        style="color: var(--primary-green); font-weight: 600;"><?php echo $item['status']; ?></span>
                                </div>
                            </div>
                            <div class="item-actions">
                                <button class="action-btn btn-outline">Edit</button>
                                <button class="action-btn btn-danger">Delete</button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>

            <!-- Members Section -->
            <section id="members" class="dashboard-section">
                <div class="manager-header">
                    <h2>Waiting List</h2>
                </div>

                <div class="list-container">
                    <?php foreach ($members as $mem): ?>
                        <div class="item-card">
                            <div class="item-info" style="display: flex; align-items: center; gap: 1rem;">
                                <div style="width: 40px; height: 40px; background: #ddd; border-radius: 50%;"></div>
                                <div>
                                    <h3><?php echo $mem['name']; ?></h3>
                                    <div class="item-meta"><?php echo $mem['role']; ?> • Applied 2 days ago</div>
                                </div>
                            </div>
                            <div class="item-actions">
                                <button class="action-btn btn-success"
                                    onclick="this.parentElement.parentElement.style.display='none'">Approve</button>
                                <button class="action-btn btn-danger"
                                    onclick="this.parentElement.parentElement.style.display='none'">Deny</button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>

            <!-- Events Section -->
            <section id="events" class="dashboard-section">
                <div class="manager-header">
                    <h2>Events Management</h2>
                    <button class="action-btn btn-primary">+ Create Event</button>
                </div>

                <div class="list-container">
                    <?php foreach ($events as $evt): ?>
                        <div class="item-card">
                            <div class="item-info">
                                <h3><?php echo $evt['name']; ?></h3>
                                <div class="item-meta">📅 <?php echo $evt['date']; ?> • 📍 <?php echo $evt['location']; ?>
                                </div>
                            </div>
                            <div class="item-actions">
                                <button class="action-btn btn-outline">Update</button>
                                <button class="action-btn btn-danger">Cancel</button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>

        </main>
    </div>

    <div class="fab" onclick="alert('Quick Action Menu')">+</div>

    <script>
        function switchTab(tabId) {
            // Hide all sections
            document.querySelectorAll('.dashboard-section').forEach(el => el.classList.remove('active'));
            // Remove active class from nav
            document.querySelectorAll('.manager-nav-item').forEach(el => el.classList.remove('active'));

            // Show target
            document.getElementById(tabId).classList.add('active');
            // Highlight nav (simple matching text content for demo)
            const navItems = document.querySelectorAll('.manager-nav-item');
            navItems.forEach(item => {
                if (item.textContent.toLowerCase().includes(tabId) ||
                    (tabId === 'members' && item.textContent.toLowerCase().includes('waiting'))) {
                    item.classList.add('active');
                }
            });
        }
    </script>
</body>

</html>