<aside>
    <nav>
        <ul>
            <li><a href="/index.php">Главная</a></li>
            <?php if (is_superadmin()): ?>
                <li><a href="/superadmin/dashboard.php">Панель супер-админа</a></li>
                <li><a href="/superadmin/create_admin.php">Создать админа</a></li>
                <li><a href="/superadmin/create_mentor.php">Создать ментора</a></li>
            <?php elseif (is_admin()): ?>
                <li><a href="/admin/dashboard.php">Панель админа</a></li>
                <li><a href="/admin/create_group.php">Создать группу</a></li>
                <li><a href="/admin/add_student.php">Добавить ученика</a></li>
                <li><a href="/admin/assign_mentor.php">Назначить ментора</a></li>
            <?php elseif (is_mentor()): ?>
                <li><a href="/mentor/dashboard.php">Панель ментора</a></li>
                <li><a href="/mentor/my_groups.php">Мои группы</a></li>
            <?php endif; ?>
            <li><a href="/auth/logout.php">Выйти</a></li>
        </ul>
    </nav>
</aside>
<main>
