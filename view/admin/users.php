<p>
    <a href="<?= $this->di->get('url')->create('admin/users/register') ?>">Skapa ny användare</a>
</p>
<table class="">
    <thead>
    <tr>
        <th>#</th>
        <th>Namn</th>
        <th>Epost</th>
        <th>Level</th>
        <th></th>
        <th></th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($users as $user) : ?>
        <tr>
            <td><?= $user['id'] ?></td>
            <td><?= $user['username'] ?></td>
            <td><?= $user['email'] ?></td>
            <td><?= $user['userlevel'] ?></td>
            <td>
                <a title="Redigera" href="<?= $this->di->get('url')->create('admin/users/edit/'.$user['id']) ?>">
                    <i class="fa fa-pencil"></i>
                </a>
            </td>
            <td>
                <a title="Gör till administratör" class="tooltip-make-admin" href="<?= $this->di->get('url')->create('admin/users/promote/'.$user['id']) ?>">
                    <i class="fa fa-unlock-alt"></i>
                </a>
            </td>
            <td>
                <a class="danger" title="Ta bort" href="<?= $this->di->get('url')->create('admin/users/delete/'.$user['id']) ?>">
                    <i class="fa fa-trash"></i>
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
