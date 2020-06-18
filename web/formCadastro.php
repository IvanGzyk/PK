<div id="layoutSidenav_content">
    <div class="container-fluid">
        <h1 class="mt-3">Cadastrar Novo Operador</h1>
        <div class="card mb-2"> </div>
        <br><br>
        <div class="container">
            <form action="create.php" method="POST" class="form-group">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Email:</label>
                        <input type="text" class="form-control" name="email" required="required">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Operador:</label>
                        <input type="text" class="form-control" name="nome" required="required">
                    </div>
                </div>
                <input type="submit" value="Cadastrar Usuário" class="btn btn-primary float-right">
            </form>
        </div>
    </div>            
</div>

