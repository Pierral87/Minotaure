<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>Id</th>
            <th>Nom</th>
            <th>Email</th>
            <th>Rôle</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><?= $user['id_user']; ?></td>
            <td><?= $user['nom']; ?></td>
            <td><?= $user['email']; ?></td>
            <td><?= $user['role']; ?></td>
            <td>
                <a class="btn btn-warning">Modifier</a>
                <a class="btn btn-danger">Supprimer</a>
            </td>
        </tr>
    </tbody>
</table>