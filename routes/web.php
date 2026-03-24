<?php
// Main dashboard routes — maps ?page=&action= to controllers

$page = $_GET['page'] ?? 'dashboard';
$action = $_GET['action'] ?? 'index';

switch ($page) {
    case 'dashboard':
        $controller = new DashboardController($db);
        if ($action === 'index') {
            $stats = $controller->getStats();
            $latest = $controller->getLatestAdditions();
            include '../views/dashboard/index.php';
        }
        break;

    case 'categories':
        $controller = new CategoryController($db);
        if ($action === 'index') {
            $controller->index();
        } elseif ($action === 'store') {
            $controller->store();
        } elseif ($action === 'update') {
            $controller->update();
        } elseif ($action === 'delete') {
            $controller->delete();
        } elseif ($action === 'get') {
            $controller->get();
        } elseif ($action === 'edit') {
            $controller->index(); // Same as index but with edit mode
        }
        break;

    case 'channels':
        $controller = new ChannelController($db);
        if ($action === 'index') {
            $controller->index();
        } elseif ($action === 'create') {
            $controller->create();
        } elseif ($action === 'edit') {
            $controller->edit();
        } elseif ($action === 'store') {
            $controller->store();
        } elseif ($action === 'update') {
            $controller->update();
        } elseif ($action === 'delete') {
            $controller->delete();
        }
        break;

    case 'movies':
        $controller = new MovieController($db);
        if ($action === 'index') {
            $controller->index();
        } elseif ($action === 'create') {
            $controller->create();
        } elseif ($action === 'edit') {
            $controller->edit();
        } elseif ($action === 'store') {
            $controller->store();
        } elseif ($action === 'update') {
            $controller->update();
        } elseif ($action === 'delete') {
            $controller->delete();
        }
        break;

    case 'anime':
        $controller = new AnimeController($db);
        if ($action === 'index') {
            $controller->index();
        } elseif ($action === 'create') {
            $controller->create();
        } elseif ($action === 'edit') {
            $controller->edit();
        } elseif ($action === 'store') {
            $controller->store();
        } elseif ($action === 'update') {
            $controller->update();
        } elseif ($action === 'delete') {
            $controller->delete();
        } elseif ($action === 'episodes') {
            $controller->episodes();
        } elseif ($action === 'add_episode') {
            $controller->add_episode();
        } elseif ($action === 'delete_episode') {
            $controller->delete_episode();
        }
        break;

    case 'ads':
        $controller = new AdController($db);
        if ($action === 'index') {
            $controller->index();
        } elseif ($action === 'save') {
            $controller->save();
        } elseif ($action === 'delete') {
            // Handle delete
        }
        break;

    case 'settings':
        $controller = new SettingsController($db);
        if ($action === 'index') {
            $controller->index();
        } elseif ($action === 'save') {
            $controller->save();
        }
        break;

    case 'login':
        $controller = new AuthController($db);
        $controller->login();
        break;

    default:
        include '../views/dashboard/index.php';
        break;
}
?>