<table class="table table-bordered table-striped mt-4">
    <thead class="table-dark">
        <tr>
            <th>Id</th>
            <th>Nom</th>
            <th>Email</th>
            <th>Role</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($users as $user) : ?>
            <tr>
                <td><?= $user["id_user"] ?></td>
                <td><?= $user["nom"] ?></td>
                <td><?= $user["email"] ?></td>
                <td><?= $user["role"] ?></td>
                <td>
                    <a class="btn btn-primary" href='?id=<?php echo $user["id_user"] ?>'>Voir</a>
                    <a class="btn btn-warning" href='?id=<?php echo $user["id_user"] ?>'>Modifier</a>
                    <a class="btn btn-danger" href='?id=<?php echo $user["id_user"] ?>'>Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>