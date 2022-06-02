<?php 
  require 'class/Main.php';
  $clients = new Clients();
  $groups = new Groups();
  $allGroups = $groups->getAllGroups();
?>
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

<div class="modal fade" id="editClient" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Cliente</h5>
        <a type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></a>
      </div>
      <div class="modal-body">
        <form id="formElemEdit">
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Nome do Cliente</label>
            <input name="client_name" required="" type="text" class="form-control clientNameEdit" placeholder="Nome do Cliente">
          </div>
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">CPF do Cliente</label>
            <input name="client_cpf" required="" type="text" class="form-control clientCPFEdit" placeholder="CPF do Cliente">
          </div>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Grupo</label>
            <select name="client_group_id" class="form-select" required="">
              <option selected>Selecione o grupo</option>
              <?php 
                forEach($allGroups as $group):
                ?>
                <option value="<?php echo $group['group_id'] ?>" class="clientGroupEdit"><?php echo $group['group_name'] ?></option>
                <?php endforeach; ?>
            </select>
            <input type="hidden" name="client_id" class="client_id" />
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

<div class="modal fade" id="addClient" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Adicionar Cliente</h5>
        <a type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></a>
      </div>
      <div class="modal-body">
        <form id="formElem">
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Nome do Cliente</label>
            <input name="client_name" required="" type="text" class="form-control" placeholder="Nome do Cliente">
          </div>
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">CPF do Cliente</label>
            <input name="client_cpf" required="" type="text" class="form-control clientCPF" placeholder="CPF do Cliente">
          </div>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Grupo</label>
            <select name="client_group_id" class="form-select" required="">
              <option selected>Selecione o grupo</option>
              <?php 
                forEach($allGroups as $group):
                ?>
                <option value="<?php echo $group['group_id'] ?>"><?php echo $group['group_desc'] ?></option>
                <?php endforeach; ?>
            </select>
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

        <a href="groups.php" class="btn btn-success">Gerenciar Grupos</a>

        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addClient">
          Adicionar Cliente
        </button>
      </div>

      <table class="table table-hover table-bordered table-striped">
        <thead class="table-primary">
          <tr>
            <th scope="col">ID cliente</th>
            <th scope="col">NOME</th>
            <th scope="col">CPF</th>
            <th scope="col">AÇÃO</th>
          </tr>
        </thead>
        <tbody></tbody>
      </table>
    </div>

    <script src="node_modules/vanilla-masker/build/vanilla-masker.min.js"></script>
    <script src="assets/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <script type="module" src="assets/js/clients_main.js"></script>
  </body>
</html>