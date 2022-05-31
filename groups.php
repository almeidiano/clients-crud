<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="assets/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/main.css" rel="stylesheet">
    <link href="node_modules/sweetalert2/dist/sweetalert2.min.css" />
    <link href="node_modules/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet" />

    <title>Clientes CRUD</title>
  </head>
  <body>

<div class="modal fade" id="editGroup" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Grupo</h5>
        <a type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></a>
      </div>
      <div class="modal-body">
        <form id="formElemEdit">
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Nome do Grupo</label>
            <input name="group_name" required="" type="text" class="form-control groupNameEdit" placeholder="Nome do Grupo">
          </div>
          <div class="form-group">
            <label for="group_desc">Descrição</label>
            <textarea required="" placeholder="Descrição do grupo" name="group_desc" class="form-control groupDescEdit" id="group_desc" rows="3"></textarea>
            <input type="hidden" name="group_id" class="group_id" />
          </div>
      </div>
      <div class="modal-footer">
        <a class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</a>
        <button type="submit" class="btn btn-primary">Editar</button>
      </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="addGroup" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Adicionar Grupo</h5>
        <a type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></a>
      </div>
      <div class="modal-body">
        <form id="formElem">
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Nome do Grupo</label>
            <input name="group_name" required="" type="text" class="form-control groupNameEdit" placeholder="Nome do Grupo">
          </div>
          <div class="form-group">
            <label for="group_desc">Descrição</label>
            <textarea required="" placeholder="Descrição do grupo" name="group_desc" class="form-control" id="group_desc" rows="3"></textarea>
          </div>
      </div>
      <div class="modal-footer">
        <a class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</a>
        <button type="submit" class="btn btn-primary">Adicionar</button>
      </div>
      </form>
    </div>
  </div>
</div>

    <nav class="navbar navbar-dark bg-primary">
      <div class="container-fluid">
        <span class="navbar-brand mb-0 h1">Clientes CRUD</span>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="options">
        <a href="index.php" class="btn btn-success">Gerenciar Clientes</a>

        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addGroup">
          Adicionar Grupo
        </button>
      </div>

      <table class="table table-hover table-bordered table-striped">
        <thead class="table-primary">
          <tr>
            <th scope="col">ID Grupo</th>
            <th scope="col">NOME</th>
            <th scope="col">AÇÃO</th>
          </tr>
        </thead>
        <tbody></tbody>
      </table>
    </div>

    <script src="node_modules/vanilla-masker/build/vanilla-masker.min.js"></script>
    <script src="assets/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <script type="module" src="assets/js/groups_main.js"></script>
  </body>
</html>