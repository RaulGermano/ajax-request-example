<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>AXAJ example</title>
</head>
<body>
<div class="container body-page">
        <div class="form-row mb-40px">
            <div class="col">
                <label>Name:</label>
                <input class="form-control shadow-flash" type="text" placeholder="Obligatory" id="input-nome" name="input-nome" required>
                <small class="form-text text-muted">EX: Raul Germano</small>
            </div>

            <div class="col">
                <label>E-Mail:</label>
                <input class="form-control shadow-flash" type="text" placeholder="Obligatory" id="input-email" name="input-email" required>
                <small class="form-text text-muted">EX: raul.germano@icloud.com</small>
            </div>
        </div>

        <button type="submit" id='button-cadastrar' class="btn btn-sm btn-danger text-white shadow-flash"><i class="fas fa-plus text-white"></i>&nbsp; Send</button>

        <table class="table table-hover table-striped data-table-format mt-50px" id='tabela-usuario'>
            <thead>
                <tr>
                    <th class="txta-left">Name</th>
                    <th class="txta-left">E-Mail</th>
                </tr>
            </thead>

            <tbody></tbody>
        </table>
    </div>

    <script>
        const lista=[
            {
                nome: 'Raul Germano',
                email: 'raul.germano@icloud.com'
            }
        ];

        function listarUsuarios(lista) {
            $('#tabela-usuario tbody tr').remove();
            
            lista.map(function(item) {
                $('#tabela-usuario tbody').append(`
                    <tr>
                        <td class='br-left-5px txta-left'>${item.nome}</td>
                        <td class='br-right-5px txta-left'>${item.email}</td>
                    </tr>
                `);
            });
        }

        listarUsuarios(lista);

        $('#button-cadastrar').on('click', function() {
            const   nome = $('#input-nome').val(),
                    email = $('#input-email').val();

            if (nome.length>0 && email.length>0){
                const   url = './validar.php',
                        formato = 'json',
                        data = {
                            nome: nome,
                            email: email
                        };

                const requis = requisicaoAssincrona(url, formato, data);

                (requis)
                    .done(function(sucesso) {
                        lista.push(sucesso);
                        listarUsuarios(lista);

                        const   apagar = {
                                    0: 'input-nome',
                                    1: 'input-email'
                                };
                    })
                    .fail(function(erro) {
                        console.error('erro');
                    });

            } else {
                console.warn('Preencha os campos "Nome" e "E-Mail"');
            }
        });

    </script>
</body>

</html>
