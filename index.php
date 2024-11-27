<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hemo Sivusto</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" />
    <link rel="stylesheet"
        href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css" />
    <link rel="stylesheet"
        href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css" />
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>
    <style>
        #kurssiTable, #opettajaTable, #opiskelijaTable, #tilaTable {
            margin-top: 1cm;
            margin-bottom: 2cm;
        }
        
        #kurssiAdd, #opettajaAdd, #opiskelijaAdd, #tilaAdd {
            display: none;
        }

    </style>
</head>

<body class="container mt-4">

    <!--  KURSSI  -->
    <div>
        <div class="d-flex align-items-center mb-3">
            <h1 class="mr-auto"> KURSSIT </h1>
            <button class="btn btn-dark" onclick="kurssiAdd()">Lisää</button>
        </div>
        <div id="kurssiAdd" class="card p-4 mt-3 shadow-sm">
            <form method="POST" action="add/kurssiAdd.php">
                <div class="form-group"><label>Nimi: </label><input type="text" name="nimi" required></div>
                <div class="form-group"><label>Kuvaus: </label><input type="text" name="kuvaus" required></div>
                <div class="form-group"><label>Alkupäivä: </label><input type="date" name="alkupaiva" required></div>
                <div class="form-group"><label>Loppupäivä: </label><input type="date" name="loppupaiva" required></div>
                <div class="form-group">
                    <label> Valitse Opettaja: </label>
                    <select name="opettaja" data-width="auto"
                        class="selectpicker" data-show-subtext="false" data-live-search="true" required>
                        <?php
                            include('conn.php');
                            $opettajaQuery = mysqli_query($conn, "SELECT * FROM `Opettaja`");
                            if (!$opettajaQuery) {
                                echo "Query failed: " . mysqli_error($conn);
                            } else {
                                if (mysqli_num_rows($opettajaQuery) == 0) {
                                    echo "No participants found.";
                                } else {
                                    while ($opettaja = mysqli_fetch_array($opettajaQuery)) {
                                        echo "<option value='{$opettaja['ID']}'>{$opettaja['Etunimi']} {$opettaja['Sukunimi']}</option>";
                                    }
                                }
                            }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label> Valitse Tilat: </label>
                    <select name="tila" data-width="auto"
                        class="selectpicker" data-show-subtext="false" data-live-search="true" required>
                        <?php
                            include('conn.php');
                            $tilaQuery = mysqli_query($conn, "SELECT * FROM `Tila`");
                            if (!$tilaQuery) {
                                echo "Query failed: " . mysqli_error($conn);
                            } else {
                                if (mysqli_num_rows($tilaQuery) == 0) {
                                    echo "No participants found.";
                                } else {
                                    while ($tila = mysqli_fetch_array($tilaQuery)) {
                                        echo "<option value='{$tila['ID']}'>{$tila['Nimi']}</option>";
                                    }
                                }
                            }
                        ?>
                    </select>
                </div>
                <input type="submit" name="add" class="btn btn-dark">
            </form>
        </div>
    </div>
    <br>
    <div id="kurssiTable">
        <table id="KurssiTable" class="table table-bordered table-striped shadow-sm mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nimi</th>
                    <th>Kuvaus</th>
                    <th>Alkupäivä</th>
                    <th>Loppupäivä</th>
                    <th>Opettaja</th>
                    <th>Tila</th>
                    <th>Osallistujat</th>
                    <th>Warning</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- SERVER SIDE -->
            </tbody>
        </table>

    </div>

    <!--  OPETTAJA  -->
    <div>
        <div class="d-flex align-items-center mb-3">
            <h1 class="mr-auto"> OPETTAJAT </h1>
            <button class="btn btn-dark" onclick="opettajaAdd()">Lisää</button>
        </div>
        <div id="opettajaAdd" class="card p-4 mt-3 shadow-sm">
            <form method="POST" action="add/opettajaAdd.php">
                <div class="form-group"><label>Etunimi: </label><input type="text" name="etunimi" required></div>
                <div class="form-group"><label>Sukunimi: </label><input type="text" name="sukunimi" required></div>
                <div class="form-group"><label>Aine: </label><input type="text" name="aine" required></div>
                <input type="submit" name="add" class="btn btn-dark">
            </form>
        </div>
    </div>
    <br>
    <div id="opettajaTable">
        <table id="OpettajaTable" class="table table-bordered table-striped shadow-sm mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Etunimi</th>
                    <th>Sukunimi</th>
                    <th>Aine</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- SERVER SIDE -->
            </tbody>
        </table>
    </div>

        <!--  Opiskelija  -->
    <div>
        <div class="d-flex align-items-center mb-3">
            <h1 class="mr-auto"> OPPILAAT </h1>
            <button class="btn btn-dark" onclick="opiskelijaAdd()">Lisää</button>
        </div>
        <div id="opiskelijaAdd" class="card p-4 mt-3 shadow-sm">
            <form method="POST" action="add/opiskelijaAdd.php">
                <div class="form-group"><label>Etunimi: </label><input type="text" name="etunimi" required></div>
                <div class="form-group"><label>Sukunimi: </label><input type="text" name="sukunimi" required></div>
                <div class="form-group"><label>Syntymäpäivä: </label><input type="date" name="syntymapaiva" required></div>
                <div class="form-group"><label>Vuosiluokka: </label><input type="text" name="vuosikurssi" required></div>
                <input type="submit" name="add" class="btn btn-dark">
            </form>
        </div>
    </div>
    <br>
    <div id="opiskelijaTable">
        <table id="OpiskelijaTable" class="table table-bordered table-striped shadow-sm mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Etunimi</th>
                    <th>Sukunimi</th>
                    <th>Syntymäpäivä</th>
                    <th>Vuosikurssi</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- SERVER SIDE -->
            </tbody>
        </table>
    </div>

            <!--  TILA  -->
    <div>
        <div class="d-flex align-items-center mb-3">
            <h1 class="mr-auto"> TILAT </h1>
            <button class="btn btn-dark" onclick="tilaAdd()">Lisää</button>
        </div>
        <div id="tilaAdd" class="card p-4 mt-3 shadow-sm">
            <form method="POST" action="add/tilaAdd.php">
                <div class="form-group"><label>Nimi: </label><input type="text" name="nimi" required></div>
                <div class="form-group"><label>Kapasiteetti: </label><input type="number" name="kapasiteetti" required></div>
                <input type="submit" name="add" class="btn btn-dark">
            </form>
        </div>
    </div>
    <br>
    <div id="tilaTable">
        <table id="TilaTable" class="table table-bordered table-striped shadow-sm mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nimi</th>
                    <th>Kapasiteetti</th>
                    <th>Kurssit</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- SERVER SIDE -->
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Hyväksy poisto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Oletko varma että haluat poistaa tämän ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <a href="#" id="confirmDeleteBtn" class="btn btn-danger">Yes</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="kurssiEdit" tabindex="-1" role="dialog"
        aria-labelledby="kurssiEditLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="edit/kurssiEdit.php">
                    <div class="modal-header">
                        <h5 class="modal-title" id="kurssiEditLabel">Muokkaa osallistujia</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="kurssiEdit-id">
                        <div class="form-group">
                            <label for="kurssiEdit-nimi">Nimi:</label>
                            <input type="text" class="form-control" id="kurssiEdit-nimi" name="nimi" required>
                        </div>
                        <div class="form-group">
                            <label for="kurssiEdit-kuvaus">Kuvaus:</label>
                            <input type="text" class="form-control" id="kurssiEdit-kuvaus" name="kuvaus" required>
                        </div>
                        <div class="form-group">
                            <label for="kurssiEdit-alkupaiva">Alkupäivä:</label>
                            <input type="date" class="form-control" id="kurssiEdit-alkupaiva" name="alkupaiva" required>
                        </div>
                        <div class="form-group">
                            <label for="kurssiEdit-loppupaiva">Loppupäivä:</label>
                            <input type="date" class="form-control" id="kurssiEdit-loppupaiva" name="loppupaiva" required>
                        </div>
                        <div class="form-group">
                            <label> Valitse Opettaja: </label>
                            <select id="kurssiEdit-opettaja" name="opettaja" data-width="auto"
                                class="selectpicker" data-show-subtext="false" data-live-search="true" required>
                                <?php
                                        include('conn.php');
                                        $opettajaQuery = mysqli_query($conn, "SELECT * FROM `Opettaja`");

                                        if (!$opettajaQuery) {
                                            echo "Query failed: " . mysqli_error($conn);
                                        } else {
                                            if (mysqli_num_rows($opettajaQuery) == 0) {
                                                echo "No participants found.";
                                            } else {
                                                while ($opettaja = mysqli_fetch_array($opettajaQuery)) {
                                                    echo "<option value='{$opettaja['ID']}'>{$opettaja['Etunimi']} {$opettaja['Sukunimi']}</option>";
                                                }
                                            }
                                        }
                                    ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label> Valitse Tila: </label>
                            <select id="kurssiEdit-tila" name="tila" data-width="auto"
                                class="selectpicker" data-show-subtext="false" data-live-search="true" required>
                                <?php
                                        include('conn.php');
                                        $tilaQuery = mysqli_query($conn, "SELECT * FROM `Tila`");

                                        if (!$tilaQuery) {
                                            echo "Query failed: " . mysqli_error($conn);
                                        } else {
                                            if (mysqli_num_rows($tilaQuery) == 0) {
                                                echo "No participants found.";
                                            } else {
                                                while ($tila = mysqli_fetch_array($tilaQuery)) {
                                                    echo "<option value='{$tila['ID']}'>{$tila['Nimi']}</option>";
                                                }
                                            }
                                        }
                                    ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Sulje</button>
                        <button type="submit" class="btn btn-dark">Tallenna</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="opettajaEdit" tabindex="-1" role="dialog"
        aria-labelledby="opettajaEditLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="edit/opettajaEdit.php">
                    <div class="modal-header">
                        <h5 class="modal-title" id="opettajaEditLabel">Muokkaa osallistujia</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="opettajaEdit-id">
                        <div class="form-group">
                            <label for="opettajaEdit-etunimi">Etunimi:</label>
                            <input type="text" class="form-control" id="opettajaEdit-etunimi" name="etunimi" required>
                        </div>
                        <div class="form-group">
                            <label for="opettajaEdit-sukunimi">Sukunimi:</label>
                            <input type="text" class="form-control" id="opettajaEdit-sukunimi" name="sukunimi" required>
                        </div>
                        <div class="form-group">
                            <label for="opettajaEdit-aine">Aine:</label>
                            <input type="text" class="form-control" id="opettajaEdit-aine" name="aine" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Sulje</button>
                        <button type="submit" class="btn btn-dark">Tallenna</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="opiskelijaEdit" tabindex="-1" role="dialog"
        aria-labelledby="opiskelijaEditLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="edit/opiskelijaEdit.php">
                    <div class="modal-header">
                        <h5 class="modal-title" id="opiskelijaEditLabel">Muokkaa osallistujia</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="opiskelijaEdit-id">
                        <div class="form-group">
                            <label for="opiskelijaEdit-etunimi">Etunimi:</label>
                            <input type="text" class="form-control" id="opiskelijaEdit-etunimi" name="etunimi" required>
                        </div>
                        <div class="form-group">
                            <label for="opiskelijaEdit-sukunimi">Sukunimi:</label>
                            <input type="text" class="form-control" id="opiskelijaEdit-sukunimi" name="sukunimi" required>
                        </div>
                        <div class="form-group">
                            <label for="opiskelijaEdit-syntymäpäivä">Syntymäpäivä:</label>
                            <input type="date" class="form-control" id="opiskelijaEdit-syntymäpäivä" name="syntymäpäivä" required>
                        </div>
                        <div class="form-group">
                            <label for="opiskelijaEdit-vuosikurssi">Vuosikurssi:</label>
                            <input type="number" class="form-control" id="opiskelijaEdit-vuosikurssi" name="vuosikurssi" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Sulje</button>
                        <button type="submit" class="btn btn-dark">Tallenna</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="tilaEdit" tabindex="-1" role="dialog"
        aria-labelledby="tilaEditLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="edit/tilaEdit.php">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tilaEditLabel">Muokkaa osallistujia</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="tilaEdit-id">
                        <div class="form-group">
                            <label for="tilaEdit-nimi">Nimi:</label>
                            <input type="text" class="form-control" id="tilaEdit-nimi" name="nimi" required>
                        </div>
                        <div class="form-group">
                            <label for="tilaEdit-kapasiteetti">Kapasiteetti:</label>
                            <input type="number" class="form-control" id="tilaEdit-kapasiteetti" name="kapasiteetti" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Sulje</button>
                        <button type="submit" class="btn btn-dark">Tallenna</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <script>
    $(document).ready(function() {
        $("#KurssiTable").DataTable({
            lengthChange: false,
            searching: false,
            ordering: false,
            serverSide: true,
            processing: true,
            ajax: {
                url: 'server.php',
                type: 'POST',
                data: function(d) {
                    d.action = "fetch_kurssi";
                }
            },
            columns: [{
                    data: 'ID'
                },
                {
                    data: 'Nimi'
                },
                {
                    data: 'Kuvaus'
                },
                {
                    data: 'Alkupaiva'
                },
                {
                    data: 'Loppupaiva'
                },
                {
                    data: 'Opettaja'
                },
                {
                    data: 'Tila'
                },
                {
                    data: 'Osallistujat',
                    render: function(data, type, row) {
                        return `${data} / ${row.Kapasiteetti}`;
                    }
                },
                {
                    data: 'Warning',
                    render: function(data) {
                        return data === 'warning' ? '<span class="text-danger">⚠️</span>' : '';
                    }
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        return `
                            <button onclick="kurssiEdit('${row.ID}', '${row.Nimi}', '${row.Kuvaus}', '${row.Alkupaiva}', '${row.Loppupaiva}', '${row.Opettaja}', '${row.Tila}')" class="btn btn-dark">Muokkaa</button>
                            <button class="btn btn-dark delete-btn" data-table="Kurssi" data-id="${row.ID}">Poista</button>
                        `;
                    }
                }
            ]
        });
        $("#OpettajaTable").DataTable({
            lengthChange: false,
            ordering: false,
            searching: false,
            serverSide: true,
            processing: true,
            ajax: {
                url: 'server.php',
                type: 'POST',
                data: function(d) {
                    d.action = 'fetch_opettaja';
                }
            },
            columns: [{
                    data: 'ID'
                },
                {
                    data: 'Etunimi'
                },
                {
                    data: 'Sukunimi'
                },
                {
                    data: 'Aine'
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        return `
                            <button onclick="opettajaEdit('${row.ID}', '${row.Etunimi}', '${row.Sukunimi}', '${row.Aine}')" class="btn btn-dark">Muokkaa</button>
                            <button class="btn btn-dark delete-btn" data-table="Opettaja" data-id="${row.ID}">Poista</button>
                        `;
                    }
                }

            ]
        });
        $("#OpiskelijaTable").DataTable({
            lengthChange: false,
            ordering: false,
            searching: false,
            serverSide: true,
            processing: true,
            ajax: {
                url: 'server.php',
                type: 'POST',
                data: function(d) {
                    d.action = 'fetch_opiskelija';
                }
            },
            columns: [{
                    data: 'ID'
                },
                {
                    data: 'Etunimi'
                },
                {
                    data: 'Sukunimi'
                },
                {
                    data: 'Syntymapaiva'
                },
                {
                    data: 'Vuosikurssi'
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        return `
                            <button onclick="opiskelijaEdit('${row.ID}', '${row.Etunimi}', '${row.Sukunimi}', '${row.Syntymapaiva}', '${row.Vuosikurssi}')" class="btn btn-dark">Muokkaa</button>
                            <button class="btn btn-dark delete-btn" data-table="Opiskelija" data-id="${row.ID}">Poista</button>
                        `;
                    }
                }

            ]
        });
        $("#TilaTable").DataTable({
            lengthChange: false,
            ordering: false,
            searching: false,
            serverSide: true,
            processing: true,
            ajax: {
                url: 'server.php',
                type: 'POST',
                data: function(d) {
                    d.action = 'fetch_tila';
                }
            },
            columns: [{
                    data: 'ID'
                },
                {
                    data: 'Nimi'
                },
                {
                    data: 'Kapasiteetti'
                },
                {
                    data: 'Kurssit'
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        return `
                            <button onclick="tilaEdit('${row.ID}', '${row.Nimi}', '${row.Kapasiteetti}')" class="btn btn-dark">Muokkaa</button>
                            <button class="btn btn-dark delete-btn" data-table="Tila" data-id="${row.ID}">Poista</button>
                        `;
                    }
                }
            ]
        });
    });
    $(document).on('click', '.delete-btn', function() {
        const table = $(this).data('table');
        const id = $(this).data('id');

        $('#deleteModal').modal('show');

        $('#confirmDeleteBtn').off('click').on('click', function() {
            $.ajax({
                url: 'delete.php',
                type: 'POST',
                data: {table, id},
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        $(`#${table}Table`).DataTable().ajax.reload();
                    } else {
                        alert('Failed to delete: ' + (response.error || 'Unknown error.'));
                    }
                },
                error: function() {
                    alert('Error');
                }
            });

            $('#deleteModal').modal('hide');
        }) 
    });
    </script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
    <script src="edit/edit.js"></script>
    <script src="add/add.js"></script>
</body>

</html>