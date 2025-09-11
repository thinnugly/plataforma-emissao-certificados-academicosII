function minMaxValidationFunc(that, value)
{
    let min = parseInt(that.getAttribute("min"));
    let max = parseInt(that.getAttribute("max"));
    let val = parseFloat(value);

    if(val < min || isNaN(val))
    {
        return min;
    }else if(val > max)
    {
        return max;
    }else
    {
        return val;
    }
}

function isInputNumber(evt)
{
    var ch = String.fromCharCode((evt.which));
    if(!(/[0-9]/.test(ch)))
    {
        evt.preventDefault();
    }
}


const setError = (element, message) =>{
    const inputControl = element.parentElement;
    const errorDisplay = inputControl.querySelector('.error');

    inputControl.classList.add('error');
    inputControl.classList.remove('success');
}

const setSuccess = element =>{
    const inputControl = element.parentElement;

    inputControl.classList.remove('error');
    inputControl.classList.add('success');
}

const validateSelectInput = () =>{
    const selectElement = document.getElementById('getStu');
    const inputElement = document.getElementById('mediaFinal');
    const selectElementValue = document.getElementById('getStu').value;
    const inputElementValue = inputElement.value;
    const inputSituacao = document.getElementById('situacao');
    const inputPortugues = document.getElementById('portugues');
    const inputIngles = document.getElementById('ingles');
    const inputFilosolia = document.getElementById('filosolia');
    const inputFisica = document.getElementById('fisica');
    const inputBiologia = document.getElementById('biologia');
    const inputQuimica = document.getElementById('quimica');
    const inputMatematica = document.getElementById('matematica');
    const inputEdfisica = document.getElementById('edfisica');
    const inputFrances = document.getElementById('frances');
    const inputGeografia = document.getElementById('geografia');
    const inputHistoria = document.getElementById('historia');
    
    let estudanteId = document.getElementById('getStu').value;
    let portugues = $('#portugues').val();
    let situacao = $('#situacao').val();
    let ingles = $('#ingles').val();
    let filosolia = $('#filosolia').val();
    let fisica = $('#fisica').val();
    let biologia = $('#biologia').val();
    let quimica = $('#quimica').val();
    let matematica = $('#matematica').val();
    let edfisica = $('#edfisica').val();
    let frances = $('#frances').val();
    let geografia = $('#geografia').val();
    let historia = $('#historia').val();
    let mediaFinal = $('#mediaFinal').val();
    

    if(selectElementValue == 0)
    {
        setError(selectElement)
    }
    else
    {
        let juri = document.getElementById('selectStuJuri').value;
        let selectJuriElement = document.getElementById('selectStuJuri');
        let selectJuriElementValue = document.getElementById('selectStuJuri').value;
        $.ajax({
            type: 'get',
            url: "/office/certificados/getStuSeccao",
            data: {'getStuNCompleto':selectElementValue},
            success: function (secca){
                for(var i=0; i<secca.length; i++){
                    if(secca[i].contacto == "Ciências Naturas (Opção B)")
                    {
                        if(inputElementValue != "" && portugues != "" && ingles != "" && filosolia != "" && fisica != ""&& biologia != "" && quimica != "" && matematica != "" && edfisica != "" && situacao != "" && selectJuriElementValue != 0)
                        {

                                var data =
                                {
                                    'estudanteId':estudanteId,
                                    'portugues':portugues,
                                    'ingles':ingles,
                                    'filosolia':filosolia,
                                    'fisica':fisica,
                                    'biologia':biologia,
                                    'quimica':quimica,
                                    'matematica':matematica,
                                    'edfisica':edfisica,
                                    'mediaFinal':mediaFinal,
                                    'juri':juri,
                                    'situacao':situacao,



                                }
                                console.log(data);
                                $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                                });

                            $.ajax({
                                type: "POST",
                                url: "/office/certificados/addData",
                                data: data,
                                dataType: "json",
                                success:function(response){
                                    //console.log(response.errors.estudanteId);
                                    if(response.status == 400)
                                    {
                                        console.log(response.errors.estudanteId);
                                        // $('#showErrMessage').show();
                                        // $('#showErrMessage').addClass('alert alert-success');
                                        // $('#showErrMessage').text(response.errors.estudanteId);
                                        Swal.fire({
                                            title: 'Operação não concluída',
                                            text: response.errors.estudanteId,
                                            icon: 'error',
                                            //showCancelButton: true,
                                            confirmButtonColor: '#3085d6',
                                            //: '#d33',
                                            confirmButtonText: 'OK'
                                        })
                                        //$('#showMessage').html("<div class='alert alert-success alert-dismissible fade show' role='alert'>O Estudante selecionado encontra-se associado à um certificado...<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>");

                                    }else
                                    {
                                        // $('#showSuccMessage').html("");
                                        //$('#showSuccMessage').html(response.message);
                                        Swal.fire({
                                            title: 'Operação concluída',
                                            text: response.message,
                                            icon: 'success',
                                            //showCancelButton: true,
                                            confirmButtonColor: '#3085d6',
                                            //: '#d33',
                                            confirmButtonText: 'OK'
                                        })
                                        fetchData();
                                        function fetchData()
                                        {
                                            $.ajax({
                                                type: "GET",
                                                url: "/office/certificados/fetchData",
                                                dataType: "json",
                                                success: function (response) {
                                                    $('tbody').html("");
                                                    getStuName();
                                                    function getStuName()
                                                        {
                                                            var op = "";
                                                            $.ajax({
                                                                type: 'get',
                                                                url: "/office/certificados/getStuName",
                                                                dataType: "json",
                                                                success: function (data){
                                                                    op+='<option value="0" selected disabled>Selecione o estudante</option>';
                                                                    for(var i=0; i<data.length; i++){
                                                                        op+='<option value="'+data[i].nomeCompleto+'">'+data[i].nomeCompleto+'</option>';
                                                                    }
                                                                    $('#getStu').html('');
                                                                    $('#getStu').append(op);
                                                                },
                                                                error: function (){
                                                                }
                                                            });
                                                        }
                                                    //console.log(response.certificados);
                                                    $('tbody').append(
                                                        '<tr>\
                                                                <td><div class="input-control"><select id="getStu" class="form-control" name="estudanteId"><option selected disabled>Selecione o estudante</option></select><span class="invalid-feedback"><strong class="error"></strong><span></div></td>\
                                                                <td contenteditable="false" id="portugues"></td>\
                                                                <td contenteditable="false" id="ingles"></td>\
                                                                <td contenteditable="false" id="frances"></td>\
                                                                <td contenteditable="false" id="filosolia"></td>\
                                                                <td contenteditable="false" id="fisica"></td>\
                                                                <td contenteditable="false" id="biologia"></td>\
                                                                <td contenteditable="false" id="quimica"></td>\
                                                                <td contenteditable="false" id="matematica"></td>\
                                                                <td contenteditable="false" id="desenho"></td>\
                                                                <td contenteditable="false" id="geografia"></td>\
                                                                <td contenteditable="false" id="edfisica"></td>\
                                                                <td contenteditable="false" id="historia"></td>\
                                                                <td contenteditable="false" id="mediaFinal"></td>\
                                                                <td contenteditable="false" id="situacao"></td>\
                                                                <td contenteditable="false" ></td>\
                                                                <td><button type="button" class="btn btn-success btn-sm" id="adcionar"><i class="fa fa-fw fa-plus"></i></button></td>\
                                                            </tr>');

                                                    $.each(response.certificados, function(key, item){
                                                        if (item.contacto == "Ciências Naturas (Opção B)") {
                                                            //console.log("Teste");
                                                            $('tbody').append(
                                                                '<tr>\
                                                                        <td contenteditable="false" data-column_name="estudanteId" id="' + item.id + '">' + item.estudanteId + '</td>\
                                                                        <td contenteditable="true" class="data-column_name" data-column_name="filosolia" id="' + item.id + '">' + item.juri + '</td>\
                                                                        <td contenteditable="true" onblur="this.value = minMaxValidationFunc(this, this.value)" min="0" max="20" class="column_name" data-column_name="portugues" id="' + item.id + '">' + item.portugues + '</td>\
                                                                        <td contenteditable="true" class="column_name" data-column_name="ingles" id="' + item.id + '">' + item.ingles + '</td>>\
                                                                        <td contenteditable="false"></td>\
                                                                        <td contenteditable="true" class="column_name" data-column_name="filosolia" id="' + item.id + '">' + item.filosolia + '</td>\
                                                                        <td contenteditable="true" class="column_name" data-column_name="fisica" id="' + item.id + '">' + item.fisica + '</td>\
                                                                        <td contenteditable="true" class="column_name" data-column_name="biologia" id="' + item.id + '">' + item.biologia + '</td>\
                                                                        <td contenteditable="true" class="column_name" data-column_name="quimica" id="' + item.id + '">' + item.quimica + '</td>\
                                                                        <td contenteditable="true" class="column_name" data-column_name="matematica" id="' + item.id + '">' + item.matematica + '</td>\
                                                                        <td contenteditable="false" class="column_name" data-column_name="desenho"></td>\
                                                                        <td contenteditable="false" class="column_name" data-column_name="geografia" ></td>\
                                                                        <td contenteditable="true" class="column_name" data-column_name="edfisica" id="' + item.id + '">' + item.edfisica + '</td>\
                                                                        <td contenteditable="false" class="column_name" data-column_name="historia"></td>\
                                                                        <td contenteditable="false" class="column_name" data-column_name="mediaFinal" id="' + item.id + '">' + item.mediaFinal + '</td>\
                                                                        <td contenteditable="false" class="column_name" data-column_name="situacao" id="' + item.id + '">' + item.situacao + '</td>\
                                                                        <td>\
                                                                            <a class="btn btn-sm btn-primary" href="/office/certificados/show/'+item.id+'"><i class="fa fa-fw fa-eye"></i></a>\
                                                                            <button type="button" data-bs-toggle="" data-bs-target="EditCertificado" class="btn btn-success btn-sm edit" id="' + item.id + '"><i class="fa fa-fw fa-edit"></i></button>\
                                                                            <button type="button" class="btn btn-danger btn-sm delete" id="' + item.id + '"><i class="fa fa-fw fa-trash"></i></button>\
                                                                        </td>\
                                                                    </tr>');
                                                        }else
                                                        {
                                                            $('tbody').append(
                                                                '<tr>\
                                                                        <td contenteditable="false" class="column_name" data-column_name="estudanteId" id="' + item.id + '">' + item.estudanteId + '</td>\
                                                                        <td contenteditable="true" data-column_name="juri" id="' + item.id + '">' + item.juri + '</td>\
                                                                        <td contenteditable="true" class="column_name" data-column_name="portugues" id="' + item.id + '">' + item.portugues + '</td>\
                                                                        <td contenteditable="true" class="column_name" data-column_name="ingles" id="' + item.id + '">' + item.ingles + '</td>\
                                                                        <td contenteditable="true" class="column_name" data-column_name="frances" id="' + item.id + '">' + item.frances + '</td>\
                                                                        <td contenteditable="false" class="column_name" data-column_name="filosolia"></td>\
                                                                        <td contenteditable="false" class="column_name" data-column_name="fisica" ></td>\
                                                                        <td contenteditable="false" class="column_name" data-column_name="biologia" ></td>\
                                                                        <td contenteditable="false" class="column_name" data-column_name="quimica" ></td>\
                                                                        <td contenteditable="true" class="column_name" data-column_name="matematica" id="' + item.id + '">' + item.matematica + '</td>\
                                                                        <td contenteditable="false" class="column_name" data-column_name="desenho"></td>\
                                                                        <td contenteditable="true" class="column_name" data-column_name="geografia" id="' + item.id + '">' + item.geografia + '</td>\
                                                                        <td contenteditable="true" class="column_name" data-column_name="edfisica" id="' + item.id + '">' + item.edfisica + '</td>\
                                                                        <td contenteditable="true" class="column_name" data-column_name="historia" id="' + item.id + '">' + item.historia + '</td>\
                                                                        <td contenteditable="false" class="column_name" data-column_name="mediaFinalF" id="' + item.id + '">' + item.mediaFinal + '</td>\
                                                                        <td contenteditable="false" class="column_name" data-column_name="situacao" id="' + item.id + '">' + item.situacao + '</td>\
                                                                        <td>\
                                                                            <a class="btn btn-sm btn-primary" href="/office/certificados/show/'+item.id+'"><i class="fa fa-fw fa-eye"></i></a>\
                                                                            <button type="button" data-bs-toggle="" data-bs-target="EditCertificado" class="btn btn-success btn-sm edit" id="' + item.id + '"><i class="fa fa-fw fa-edit"></i></button>\
                                                                            <button type="button" class="btn btn-danger btn-sm delete" id="' + item.id + '"><i class="fa fa-fw fa-trash"></i></button>\
                                                                        </td>\
                                                                </tr>');
                                                        }

                                                    });

                                                }
                                            });
                                        }
                                        

                                    }
                                }

                            });

                        }
                        else
                        {
                            
                            if(selectJuriElementValue == 0)
                            {
                                setError(selectJuriElement);
                            }
                            if(inputElementValue === "" )
                            {
                                setError(inputElement);
                            }
                            if(portugues === "" )
                            {
                                setError(inputPortugues)
                            }
                            if(filosolia === "")
                            {
                                setError(inputFilosolia);
                            }
                            if(ingles === "" )
                            {
                                setError(inputIngles);
                            }
                            if(fisica === "" )
                            {
                                setError(inputFisica);
                            }
                            if(biologia === "" )
                            {
                                setError(inputBiologia);
                            }
                            if(quimica === "" )
                            {
                                setError(inputQuimica);
                            }
                            if(matematica === "" )
                            {
                                setError(inputMatematica);
                            }
                            if(edfisica === "" )
                            {
                                setError(inputEdfisica);
                            }
                            if(situacao === "" )
                            {
                                setError(inputSituacao);
                            }
                            if(selectJuriElementValue == 0 )
                            {
                                setError(selectJuriElement);
                            }

                        }



                    }else if(secca[i].contacto == "Letras com Matematica (Opção A)")
                    {
                        if(inputElementValue != "" && portugues != "" && ingles != "" && frances != "" && geografia != ""&& historia != "" && matematica != "" && edfisica != "" && situacao != "" && selectJuriElementValue != 0)
                        {
                            var data =
                                {
                                    'estudanteId':estudanteId,
                                    'portugues':portugues,
                                    'ingles':ingles,
                                    'matematica':matematica,
                                    'edfisica':edfisica,
                                    'frances':frances,
                                    'geografia':geografia,
                                    'historia': historia,
                                    'mediaFinal':mediaFinal,
                                    'juri':juri,
                                    'situacao':situacao,


                                }
                                console.log(data);
                                $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                                });
                                $.ajax({
                                    type: "POST",
                                    url: "/office/certificados/addData",
                                    data: data,
                                    dataType: "json",
                                    success:function(response){
                                        if(response.status == 400)
                                        {
                                            // $('#showErrMessage').show();
                                            // $('#showErrMessage').addClass('alert alert-success');
                                            // $('#showErrMessage').text(response.errors.estudanteId);
                                            Swal.fire({
                                                title: 'Operação não concluída',
                                                text: response.errors.estudanteId,
                                                icon: 'error',
                                                //showCancelButton: true,
                                                confirmButtonColor: '#3085d6',
                                                //: '#d33',
                                                confirmButtonText: 'OK'
                                            })


                                        }else
                                        {
                                            //$('#showSuccMessage').html("");
                                            //$('#showSuccMessage').html(response.message);
                                            Swal.fire({
                                                title: 'Operação concluída',
                                                text: response.message,
                                                icon: 'success',
                                                //showCancelButton: true,
                                                confirmButtonColor: '#3085d6',
                                                //: '#d33',
                                                confirmButtonText: 'OK'
                                            })
                                            fetchData();
                                            function fetchData()
                                            {
                                                $.ajax({
                                                    type: "GET",
                                                    url: "/office/certificados/fetchData",
                                                    dataType: "json",
                                                    success: function (response) {
                                                        $('tbody').html("");
                                                        getStuName();
                                                        function getStuName()
                                                            {
                                                                var op = "";
                                                                $.ajax({
                                                                    type: 'get',
                                                                    url: "/office/certificados/getStuName",
                                                                    dataType: "json",
                                                                    success: function (data){
                                                                        op+='<option value="0" selected disabled>Selecione o estudante</option>';
                                                                        for(var i=0; i<data.length; i++){
                                                                            op+='<option value="'+data[i].nomeCompleto+'">'+data[i].nomeCompleto+'</option>';
                                                                        }
                                                                        $('#getStu').html('');
                                                                        $('#getStu').append(op);
                                                                    },
                                                                    error: function (){
                                                                    }
                                                                });
                                                            }
                                                        //console.log(response.certificados);
                                                        $('tbody').append(
                                                            '<tr>\
                                                                    <td><div class="input-control"><select id="getStu" class="form-control" name="estudanteId"><option selected disabled>Selecione o estudante</option></select><span class="invalid-feedback"><strong class="error"></strong><span></div></td>\
                                                                    <td contenteditable="false" id="portugues"></td>\
                                                                    <td contenteditable="false" id="ingles"></td>\
                                                                    <td contenteditable="false" id="frances"></td>\
                                                                    <td contenteditable="false" id="filosolia"></td>\
                                                                    <td contenteditable="false" id="fisica"></td>\
                                                                    <td contenteditable="false" id="biologia"></td>\
                                                                    <td contenteditable="false" id="quimica"></td>\
                                                                    <td contenteditable="false" id="matematica"></td>\
                                                                    <td contenteditable="false" id="desenho"></td>\
                                                                    <td contenteditable="false" id="geografia"></td>\
                                                                    <td contenteditable="false" id="edfisica"></td>\
                                                                    <td contenteditable="false" id="historia"></td>\
                                                                    <td contenteditable="false" id="mediaFinal"></td>\
                                                                    <td contenteditable="false" id="situacao"></td>\
                                                                    <td contenteditable="false" ></td>\
                                                                    <td><button type="button" class="btn btn-success btn-sm" id="adcionar"><i class="fa fa-fw fa-plus"></i></button></td>\
                                                                </tr>');

                                                        $.each(response.certificados, function(key, item){
                                                            if (item.contacto == "Ciências Naturas (Opção B)") {
                                                                //console.log("Teste");
                                                                $('tbody').append(
                                                                    '<tr>\
                                                                            <td contenteditable="false" data-column_name="estudanteId" id="' + item.id + '">' + item.estudanteId + '</td>\
                                                                            <td contenteditable="true" class="data-column_name" data-column_name="filosolia" id="' + item.id + '">' + item.juri + '</td>\
                                                                            <td contenteditable="true" onblur="this.value = minMaxValidationFunc(this, this.value)" min="0" max="20" class="column_name" data-column_name="portugues" id="' + item.id + '">' + item.portugues + '</td>\
                                                                            <td contenteditable="true" class="column_name" data-column_name="ingles" id="' + item.id + '">' + item.ingles + '</td>>\
                                                                            <td contenteditable="false"></td>\
                                                                            <td contenteditable="true" class="column_name" data-column_name="filosolia" id="' + item.id + '">' + item.filosolia + '</td>\
                                                                            <td contenteditable="true" class="column_name" data-column_name="fisica" id="' + item.id + '">' + item.fisica + '</td>\
                                                                            <td contenteditable="true" class="column_name" data-column_name="biologia" id="' + item.id + '">' + item.biologia + '</td>\
                                                                            <td contenteditable="true" class="column_name" data-column_name="quimica" id="' + item.id + '">' + item.quimica + '</td>\
                                                                            <td contenteditable="true" class="column_name" data-column_name="matematica" id="' + item.id + '">' + item.matematica + '</td>\
                                                                            <td contenteditable="false" class="column_name" data-column_name="desenho"></td>\
                                                                            <td contenteditable="false" class="column_name" data-column_name="geografia" ></td>\
                                                                            <td contenteditable="true" class="column_name" data-column_name="edfisica" id="' + item.id + '">' + item.edfisica + '</td>\
                                                                            <td contenteditable="false" class="column_name" data-column_name="historia"></td>\
                                                                            <td contenteditable="false" class="column_name" data-column_name="mediaFinal" id="' + item.id + '">' + item.mediaFinal + '</td>\
                                                                            <td contenteditable="false" class="column_name" data-column_name="situacao" id="' + item.id + '">' + item.situacao + '</td>\
                                                                            <td>\
                                                                                <a class="btn btn-sm btn-primary" href="/office/certificados/show/'+item.id+'"><i class="fa fa-fw fa-eye"></i></a>\
                                                                                <button type="button" data-bs-toggle="" data-bs-target="EditCertificado" class="btn btn-success btn-sm edit" id="' + item.id + '"><i class="fa fa-fw fa-edit"></i></button>\
                                                                                <button type="button" class="btn btn-danger btn-sm delete" id="' + item.id + '"><i class="fa fa-fw fa-trash"></i></button>\
                                                                            </td>\
                                                                        </tr>');
                                                            }else
                                                            {
                                                                $('tbody').append(
                                                                    '<tr>\
                                                                            <td contenteditable="false" class="column_name" data-column_name="estudanteId" id="' + item.id + '">' + item.estudanteId + '</td>\
                                                                            <td contenteditable="true" data-column_name="juri" id="' + item.id + '">' + item.juri + '</td>\
                                                                            <td contenteditable="true" class="column_name" data-column_name="portugues" id="' + item.id + '">' + item.portugues + '</td>\
                                                                            <td contenteditable="true" class="column_name" data-column_name="ingles" id="' + item.id + '">' + item.ingles + '</td>\
                                                                            <td contenteditable="true" class="column_name" data-column_name="frances" id="' + item.id + '">' + item.frances + '</td>\
                                                                            <td contenteditable="false" class="column_name" data-column_name="filosolia"></td>\
                                                                            <td contenteditable="false" class="column_name" data-column_name="fisica" ></td>\
                                                                            <td contenteditable="false" class="column_name" data-column_name="biologia" ></td>\
                                                                            <td contenteditable="false" class="column_name" data-column_name="quimica" ></td>\
                                                                            <td contenteditable="true" class="column_name" data-column_name="matematica" id="' + item.id + '">' + item.matematica + '</td>\
                                                                            <td contenteditable="false" class="column_name" data-column_name="desenho"></td>\
                                                                            <td contenteditable="true" class="column_name" data-column_name="geografia" id="' + item.id + '">' + item.geografia + '</td>\
                                                                            <td contenteditable="true" class="column_name" data-column_name="edfisica" id="' + item.id + '">' + item.edfisica + '</td>\
                                                                            <td contenteditable="true" class="column_name" data-column_name="historia" id="' + item.id + '">' + item.historia + '</td>\
                                                                            <td contenteditable="false" class="column_name" data-column_name="mediaFinalF" id="' + item.id + '">' + item.mediaFinal + '</td>\
                                                                            <td contenteditable="false" class="column_name" data-column_name="situacao" id="' + item.id + '">' + item.situacao + '</td>\
                                                                            <td>\
                                                                                <a class="btn btn-sm btn-primary" href="/office/certificados/show/'+item.id+'"><i class="fa fa-fw fa-eye"></i></a>\
                                                                                <button type="button" data-bs-toggle="" data-bs-target="EditCertificado" class="btn btn-success btn-sm edit" id="' + item.id + '"><i class="fa fa-fw fa-edit"></i></button>\
                                                                                <button type="button" class="btn btn-danger btn-sm delete" id="' + item.id + '"><i class="fa fa-fw fa-trash"></i></button>\
                                                                            </td>\
                                                                    </tr>');
                                                            }

                                                        });

                                                    }
                                                });
                                            }
                                        }
                                    }
                                });

                        }else
                        {
                            if(inputElementValue === "" )
                            {
                                setError(inputElement);
                            }
                            if(portugues === "" )
                            {
                                setError(inputPortugues)
                            }
                            if(frances === "")
                            {
                                setError(inputFrances);
                            }
                            if(ingles === "" )
                            {
                                setError(inputIngles);
                            }
                            if(geografia === "" )
                            {
                                setError(inputGeografia);
                            }
                            if(historia === "" )
                            {
                                setError(inputHistoria);
                            }

                            if(matematica === "" )
                            {
                                setError(inputMatematica);
                            }
                            if(edfisica === "" )
                            {
                                setError(inputEdfisica);
                            }
                            if(situacao === "" )
                            {
                                setError(inputSituacao);
                            }
                            if(selectJuriElementValue == 0 )
                            {
                                setError(selectJuriElement);
                            }

                        }
                    }
                }
                }
            });





    }



}

const setErrorEdit = (element) =>{
    const inputControl = element.parentElement;

    inputControl.classList.add('error');
    inputControl.classList.remove('success');
}

const validateSelectInputEdit = () =>{
    const inputElement = document.getElementById('mediaFinal');
    const inputElementValue = inputElement.value;
    const inputEstudanteId = document.getElementById('estudanteId');
    const inputPortugues = document.getElementById('portugues');
    const inputIngles = document.getElementById('ingles');
    const inputFilosolia = document.getElementById('filosolia');
    const inputFisica = document.getElementById('fisica');
    const inputBiologia = document.getElementById('biologia');
    const inputQuimica = document.getElementById('quimica');
    const inputMatematica = document.getElementById('matematica');
    const inputEdfisica = document.getElementById('edfisica');
    const inputFrances = document.getElementById('frances');
    const inputGeografia = document.getElementById('geografia');
    const inputHistoria = document.getElementById('historia');
    let estudanteId = $('#estudanteId').val();
    let portugues = $('#portugues').val();
    let ingles = $('#ingles').val();
    let filosolia = $('#filosolia').val();
    let fisica = $('#fisica').val();
    let biologia = $('#biologia').val();
    let quimica = $('#quimica').val();
    let matematica = $('#matematica').val();
    let edfisica = $('#edfisica').val();
    let frances = $('#frances').val();
    let geografia = $('#geografia').val();
    let historia = $('#historia').val();
    let mediaFinal = $('#mediaFinal').val();

    let selectJuriElement = document.getElementById('selectStuJuri');
    let selectJuriElementValue = document.getElementById('selectStuJuri').value;
    let situacao = $('#situacao').val();
    let juri = document.getElementById('selectStuJuri').value;

    let getCertIdToUpdate = $('#getCertId').val();
                $.ajax({
                    type: 'get',
                    url: '/office/certificados/getStuSeccaoByCertId',
                    data: {'id':getCertIdToUpdate},
                    success: function(studCertSessao){
                        for (let index = 0; index < studCertSessao.length; index++) {
                            if(studCertSessao[index].contacto == "Ciências Naturas (Opção B)")
                            {
                                if(estudanteId != "" && portugues != "" && ingles != "" && filosolia != "" && fisica != ""&& biologia != "" && quimica != "" && matematica != "" && edfisica != "" && situacao != "" && selectJuriElementValue != 0)
                                {

                                    var data =
                                    {
                                        'estudanteId':estudanteId,
                                        'portugues':portugues,
                                        'ingles':ingles,
                                        'filosolia':filosolia,
                                        'fisica':fisica,
                                        'biologia':biologia,
                                        'quimica':quimica,
                                        'matematica':matematica,
                                        'edfisica':edfisica,
                                        'mediaFinal':mediaFinal,
                                        'juri':juri,
                                        'situacao':situacao,

                                    }
                                    $.ajaxSetup({
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        }
                                    });
                                    $.ajax({
                                        type: "PUT",
                                        url: "/office/certificados/update/"+getCertIdToUpdate,
                                        data: data,
                                        dataType: "json",
                                        success:function(response)
                                        {
                                            if(response.status == 400)
                                            {
                                                $('#showErrMessage').show();
                                                $('#showErrMessage').addClass('alert alert-success');
                                                //$('#showErrMessage').text(response.errors.estudanteId);
                                                $('#editCertificado').modal('hide');
                                                Swal.fire({
                                                    title: 'Operação não concluída',
                                                    text: response.message,
                                                    icon: 'error',
                                                    //showCancelButton: true,
                                                    confirmButtonColor: '#3085d6',
                                                    //: '#d33',
                                                    confirmButtonText: 'OK'
                                                })
                                            }
                                            else if(response.status == 404)
                                            {
                                                $('#showSuccMessage').html("");
                                                //$('#showSuccMessage').html(response.message);
                                                $('#editCertificado').modal('hide');
                                                Swal.fire({
                                                    title: 'Operação não concluída',
                                                    text: response.message,
                                                    icon: 'error',
                                                    //showCancelButton: true,
                                                    confirmButtonColor: '#3085d6',
                                                    //: '#d33',
                                                    confirmButtonText: 'OK'
                                                })
                                            }else
                                            {
                                                $('#showSuccMessage').html("");
                                                // $('#showSuccMessage').html(response.message);
                                                $('#editCertificado').modal('hide');
                                                Swal.fire({
                                                    title: 'Operação concluída',
                                                    text: response.message,
                                                    icon: 'success',
                                                    //showCancelButton: true,
                                                    confirmButtonColor: '#3085d6',
                                                    //: '#d33',
                                                    confirmButtonText: 'OK'
                                                })
                                                fetchData();
                                                function fetchData()
                                                {
                                                    $.ajax({
                                                        type: "GET",
                                                        url: "/office/certificados/fetchData",
                                                        dataType: "json",
                                                        success: function (response) {
                                                            $('tbody').html("");
                                                            getStuName();
                                                            function getStuName()
                                                                {
                                                                    var op = "";
                                                                    $.ajax({
                                                                        type: 'get',
                                                                        url: "/office/certificados/getStuName",
                                                                        dataType: "json",
                                                                        success: function (data){
                                                                            op+='<option value="0" selected disabled>Selecione o estudante</option>';
                                                                            for(var i=0; i<data.length; i++){
                                                                                op+='<option value="'+data[i].nomeCompleto+'">'+data[i].nomeCompleto+'</option>';
                                                                            }
                                                                            $('#getStu').html('');
                                                                            $('#getStu').append(op);
                                                                        },
                                                                        error: function (){
                                                                        }
                                                                    });
                                                                }
                                                            //console.log(response.certificados);
                                                            $('tbody').append(
                                                                '<tr>\
                                                                        <td><div class="input-control"><select id="getStu" class="form-control" name="estudanteId"><option selected disabled>Selecione o estudante</option></select><span class="invalid-feedback"><strong class="error"></strong><span></div></td>\
                                                                        <td contenteditable="false" id="portugues"></td>\
                                                                        <td contenteditable="false" id="ingles"></td>\
                                                                        <td contenteditable="false" id="frances"></td>\
                                                                        <td contenteditable="false" id="filosolia"></td>\
                                                                        <td contenteditable="false" id="fisica"></td>\
                                                                        <td contenteditable="false" id="biologia"></td>\
                                                                        <td contenteditable="false" id="quimica"></td>\
                                                                        <td contenteditable="false" id="matematica"></td>\
                                                                        <td contenteditable="false" id="desenho"></td>\
                                                                        <td contenteditable="false" id="geografia"></td>\
                                                                        <td contenteditable="false" id="edfisica"></td>\
                                                                        <td contenteditable="false" id="historia"></td>\
                                                                        <td contenteditable="false" id="mediaFinal"></td>\
                                                                        <td contenteditable="false" id="situacao"></td>\
                                                                        <td contenteditable="false" ></td>\
                                                                        <td><button type="button" class="btn btn-success btn-sm" id="adcionar"><i class="fa fa-fw fa-plus"></i></button></td>\
                                                                    </tr>');

                                                            $.each(response.certificados, function(key, item){
                                                                if (item.contacto == "Ciências Naturas (Opção B)") {
                                                                    //console.log("Teste");
                                                                    $('tbody').append(
                                                                        '<tr>\
                                                                                <td contenteditable="false" data-column_name="estudanteId" id="' + item.id + '">' + item.estudanteId + '</td>\
                                                                                <td contenteditable="true" class="data-column_name" data-column_name="filosolia" id="' + item.id + '">' + item.juri + '</td>\
                                                                                <td contenteditable="true" onblur="this.value = minMaxValidationFunc(this, this.value)" min="0" max="20" class="column_name" data-column_name="portugues" id="' + item.id + '">' + item.portugues + '</td>\
                                                                                <td contenteditable="true" class="column_name" data-column_name="ingles" id="' + item.id + '">' + item.ingles + '</td>>\
                                                                                <td contenteditable="false"></td>\
                                                                                <td contenteditable="true" class="column_name" data-column_name="filosolia" id="' + item.id + '">' + item.filosolia + '</td>\
                                                                                <td contenteditable="true" class="column_name" data-column_name="fisica" id="' + item.id + '">' + item.fisica + '</td>\
                                                                                <td contenteditable="true" class="column_name" data-column_name="biologia" id="' + item.id + '">' + item.biologia + '</td>\
                                                                                <td contenteditable="true" class="column_name" data-column_name="quimica" id="' + item.id + '">' + item.quimica + '</td>\
                                                                                <td contenteditable="true" class="column_name" data-column_name="matematica" id="' + item.id + '">' + item.matematica + '</td>\
                                                                                <td contenteditable="false" class="column_name" data-column_name="desenho"></td>\
                                                                                <td contenteditable="false" class="column_name" data-column_name="geografia" ></td>\
                                                                                <td contenteditable="true" class="column_name" data-column_name="edfisica" id="' + item.id + '">' + item.edfisica + '</td>\
                                                                                <td contenteditable="false" class="column_name" data-column_name="historia"></td>\
                                                                                <td contenteditable="false" class="column_name" data-column_name="mediaFinal" id="' + item.id + '">' + item.mediaFinal + '</td>\
                                                                                <td contenteditable="false" class="column_name" data-column_name="situacao" id="' + item.id + '">' + item.situacao + '</td>\
                                                                                <td>\
                                                                                    <a class="btn btn-sm btn-primary" href="/office/certificados/show/'+item.id+'"><i class="fa fa-fw fa-eye"></i></a>\
                                                                                    <button type="button" data-bs-toggle="" data-bs-target="EditCertificado" class="btn btn-success btn-sm edit" id="' + item.id + '"><i class="fa fa-fw fa-edit"></i></button>\
                                                                                    <button type="button" class="btn btn-danger btn-sm delete" id="' + item.id + '"><i class="fa fa-fw fa-trash"></i></button>\
                                                                                </td>\
                                                                            </tr>');
                                                                }else
                                                                {
                                                                    $('tbody').append(
                                                                        '<tr>\
                                                                                <td contenteditable="false" class="column_name" data-column_name="estudanteId" id="' + item.id + '">' + item.estudanteId + '</td>\
                                                                                <td contenteditable="true" data-column_name="juri" id="' + item.id + '">' + item.juri + '</td>\
                                                                                <td contenteditable="true" class="column_name" data-column_name="portugues" id="' + item.id + '">' + item.portugues + '</td>\
                                                                                <td contenteditable="true" class="column_name" data-column_name="ingles" id="' + item.id + '">' + item.ingles + '</td>\
                                                                                <td contenteditable="true" class="column_name" data-column_name="frances" id="' + item.id + '">' + item.frances + '</td>\
                                                                                <td contenteditable="false" class="column_name" data-column_name="filosolia"></td>\
                                                                                <td contenteditable="false" class="column_name" data-column_name="fisica" ></td>\
                                                                                <td contenteditable="false" class="column_name" data-column_name="biologia" ></td>\
                                                                                <td contenteditable="false" class="column_name" data-column_name="quimica" ></td>\
                                                                                <td contenteditable="true" class="column_name" data-column_name="matematica" id="' + item.id + '">' + item.matematica + '</td>\
                                                                                <td contenteditable="false" class="column_name" data-column_name="desenho"></td>\
                                                                                <td contenteditable="true" class="column_name" data-column_name="geografia" id="' + item.id + '">' + item.geografia + '</td>\
                                                                                <td contenteditable="true" class="column_name" data-column_name="edfisica" id="' + item.id + '">' + item.edfisica + '</td>\
                                                                                <td contenteditable="true" class="column_name" data-column_name="historia" id="' + item.id + '">' + item.historia + '</td>\
                                                                                <td contenteditable="false" class="column_name" data-column_name="mediaFinalF" id="' + item.id + '">' + item.mediaFinal + '</td>\
                                                                                <td contenteditable="false" class="column_name" data-column_name="situacao" id="' + item.id + '">' + item.situacao + '</td>\
                                                                                <td>\
                                                                                    <a class="btn btn-sm btn-primary" href="/office/certificados/show/'+item.id+'"><i class="fa fa-fw fa-eye"></i></a>\
                                                                                    <button type="button" data-bs-toggle="" data-bs-target="EditCertificado" class="btn btn-success btn-sm edit" id="' + item.id + '"><i class="fa fa-fw fa-edit"></i></button>\
                                                                                    <button type="button" class="btn btn-danger btn-sm delete" id="' + item.id + '"><i class="fa fa-fw fa-trash"></i></button>\
                                                                                </td>\
                                                                        </tr>');
                                                                }

                                                            });

                                                        }
                                                    });
                                                }
                                            }
                                        }
                                    });
                                }else
                                {
                                    if(inputElementValue === "" )
                                    {
                                        setError(inputElement);
                                    }
                                    if(portugues === "" )
                                    {
                                        setError(inputPortugues)
                                    }
                                    if(filosolia === "")
                                    {
                                        setError(inputFilosolia);
                                    }
                                    if(ingles === "" )
                                    {
                                        setError(inputIngles);
                                    }
                                    if(fisica === "" )
                                    {
                                        setError(inputFisica);
                                    }
                                    if(biologia === "" )
                                    {
                                        setError(inputBiologia);
                                    }
                                    if(quimica === "" )
                                    {
                                        setError(inputQuimica);
                                    }
                                    if(matematica === "" )
                                    {
                                        setError(inputMatematica);
                                    }
                                    if(edfisica === "" )
                                    {
                                        setError(inputEdfisica);
                                    }if(situacao === "" )
                                    {
                                        setError(inputSituacao);
                                    }
                                    if(selectJuriElementValue == 0 )
                                    {
                                        setError(selectJuriElement);
                                    }

                                }

                            }else
                            {
                                if(estudanteId != "" && portugues != "" && ingles != "" && frances != "" && geografia != ""&& historia != "" && matematica != "" && edfisica != "" && situacao != "" && selectJuriElementValue != 0)
                                {
                                    var data =
                                    {
                                        'estudanteId':estudanteId,
                                        'portugues':portugues,
                                        'ingles':ingles,
                                        'matematica':matematica,
                                        'edfisica':edfisica,
                                        'frances':frances,
                                        'geografia':geografia,
                                        'historia': historia,
                                        'mediaFinal':mediaFinal,
                                        'juri':juri,
                                        'situacao':situacao,

                                    }
                                    $.ajaxSetup({
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        }
                                    });
                                    $.ajax({
                                        type: "PUT",
                                        url: "/office/certificados/update/"+getCertIdToUpdate,
                                        data: data,
                                        dataType: "json",
                                        success:function(response)
                                        {
                                            if(response.status == 400)
                                            {
                                                $('#showErrMessage').show();
                                                $('#showErrMessage').addClass('alert alert-success');
                                                //$('#showErrMessage').text(response.errors.estudanteId);
                                                $('#editCertificado').modal('hide');
                                                Swal.fire({
                                                    title: 'Operação não concluída',
                                                    text: response.message,
                                                    icon: 'error',
                                                    //showCancelButton: true,
                                                    confirmButtonColor: '#3085d6',
                                                    //: '#d33',
                                                    confirmButtonText: 'OK'
                                                })
                                            }
                                            else if(response.status == 404)
                                            {
                                                $('#showSuccMessage').html("");
                                                //$('#showSuccMessage').html(response.message);
                                                $('#editCertificado').modal('hide');
                                                //$('#editCertificado').modal('hide');
                                                Swal.fire({
                                                    title: 'Operação não concluída',
                                                    text: response.message,
                                                    icon: 'error',
                                                    //showCancelButton: true,
                                                    confirmButtonColor: '#3085d6',
                                                    //: '#d33',
                                                    confirmButtonText: 'OK'
                                                })
                                            }else
                                            {
                                                $('#showSuccMessage').html("");
                                                // $('#showSuccMessage').html(response.message);
                                                $('#editCertificado').modal('hide');
                                                Swal.fire({
                                                    title: 'Operação concluída',
                                                    text: response.message,
                                                    icon: 'success',
                                                    //showCancelButton: true,
                                                    confirmButtonColor: '#3085d6',
                                                    //: '#d33',
                                                    confirmButtonText: 'OK'
                                                })
                                                fetchData();
                                                function fetchData()
                                                {
                                                    $.ajax({
                                                        type: "GET",
                                                        url: "/office/certificados/fetchData",
                                                        dataType: "json",
                                                        success: function (response) {
                                                            $('tbody').html("");
                                                            getStuName();
                                                            function getStuName()
                                                                {
                                                                    var op = "";
                                                                    $.ajax({
                                                                        type: 'get',
                                                                        url: "/office/certificados/getStuName",
                                                                        dataType: "json",
                                                                        success: function (data){
                                                                            op+='<option value="0" selected disabled>Selecione o estudante</option>';
                                                                            for(var i=0; i<data.length; i++){
                                                                                op+='<option value="'+data[i].nomeCompleto+'">'+data[i].nomeCompleto+'</option>';
                                                                            }
                                                                            $('#getStu').html('');
                                                                            $('#getStu').append(op);
                                                                        },
                                                                        error: function (){
                                                                        }
                                                                    });
                                                                }
                                                            //console.log(response.certificados);
                                                            $('tbody').append(
                                                                '<tr>\
                                                                        <td><div class="input-control"><select id="getStu" class="form-control" name="estudanteId"><option selected disabled>Selecione o estudante</option></select><span class="invalid-feedback"><strong class="error"></strong><span></div></td>\
                                                                        <td contenteditable="false" id="portugues"></td>\
                                                                        <td contenteditable="false" id="ingles"></td>\
                                                                        <td contenteditable="false" id="frances"></td>\
                                                                        <td contenteditable="false" id="filosolia"></td>\
                                                                        <td contenteditable="false" id="fisica"></td>\
                                                                        <td contenteditable="false" id="biologia"></td>\
                                                                        <td contenteditable="false" id="quimica"></td>\
                                                                        <td contenteditable="false" id="matematica"></td>\
                                                                        <td contenteditable="false" id="desenho"></td>\
                                                                        <td contenteditable="false" id="geografia"></td>\
                                                                        <td contenteditable="false" id="edfisica"></td>\
                                                                        <td contenteditable="false" id="historia"></td>\
                                                                        <td contenteditable="false" id="mediaFinal"></td>\
                                                                        <td contenteditable="false" id="situacao"></td>\
                                                                        <td contenteditable="false" ></td>\
                                                                        <td><button type="button" class="btn btn-success btn-sm" id="adcionar"><i class="fa fa-fw fa-plus"></i></button></td>\
                                                                    </tr>');

                                                            $.each(response.certificados, function(key, item){
                                                                if (item.contacto == "Ciências Naturas (Opção B)") {
                                                                    //console.log("Teste");
                                                                    $('tbody').append(
                                                                        '<tr>\
                                                                                <td contenteditable="false" data-column_name="estudanteId" id="' + item.id + '">' + item.estudanteId + '</td>\
                                                                                <td contenteditable="true" class="data-column_name" data-column_name="filosolia" id="' + item.id + '">' + item.juri + '</td>\
                                                                                <td contenteditable="true" onblur="this.value = minMaxValidationFunc(this, this.value)" min="0" max="20" class="column_name" data-column_name="portugues" id="' + item.id + '">' + item.portugues + '</td>\
                                                                                <td contenteditable="true" class="column_name" data-column_name="ingles" id="' + item.id + '">' + item.ingles + '</td>>\
                                                                                <td contenteditable="false"></td>\
                                                                                <td contenteditable="true" class="column_name" data-column_name="filosolia" id="' + item.id + '">' + item.filosolia + '</td>\
                                                                                <td contenteditable="true" class="column_name" data-column_name="fisica" id="' + item.id + '">' + item.fisica + '</td>\
                                                                                <td contenteditable="true" class="column_name" data-column_name="biologia" id="' + item.id + '">' + item.biologia + '</td>\
                                                                                <td contenteditable="true" class="column_name" data-column_name="quimica" id="' + item.id + '">' + item.quimica + '</td>\
                                                                                <td contenteditable="true" class="column_name" data-column_name="matematica" id="' + item.id + '">' + item.matematica + '</td>\
                                                                                <td contenteditable="false" class="column_name" data-column_name="desenho"></td>\
                                                                                <td contenteditable="false" class="column_name" data-column_name="geografia" ></td>\
                                                                                <td contenteditable="true" class="column_name" data-column_name="edfisica" id="' + item.id + '">' + item.edfisica + '</td>\
                                                                                <td contenteditable="false" class="column_name" data-column_name="historia"></td>\
                                                                                <td contenteditable="false" class="column_name" data-column_name="mediaFinal" id="' + item.id + '">' + item.mediaFinal + '</td>\
                                                                                <td contenteditable="false" class="column_name" data-column_name="situacao" id="' + item.id + '">' + item.situacao + '</td>\
                                                                                <td>\
                                                                                    <a class="btn btn-sm btn-primary" href="/office/certificados/show/'+item.id+'"><i class="fa fa-fw fa-eye"></i></a>\
                                                                                    <button type="button" data-bs-toggle="" data-bs-target="EditCertificado" class="btn btn-success btn-sm edit" id="' + item.id + '"><i class="fa fa-fw fa-edit"></i></button>\
                                                                                    <button type="button" class="btn btn-danger btn-sm delete" id="' + item.id + '"><i class="fa fa-fw fa-trash"></i></button>\
                                                                                </td>\
                                                                            </tr>');
                                                                }else
                                                                {
                                                                    $('tbody').append(
                                                                        '<tr>\
                                                                                <td contenteditable="false" class="column_name" data-column_name="estudanteId" id="' + item.id + '">' + item.estudanteId + '</td>\
                                                                                <td contenteditable="true" data-column_name="juri" id="' + item.id + '">' + item.juri + '</td>\
                                                                                <td contenteditable="true" class="column_name" data-column_name="portugues" id="' + item.id + '">' + item.portugues + '</td>\
                                                                                <td contenteditable="true" class="column_name" data-column_name="ingles" id="' + item.id + '">' + item.ingles + '</td>\
                                                                                <td contenteditable="true" class="column_name" data-column_name="frances" id="' + item.id + '">' + item.frances + '</td>\
                                                                                <td contenteditable="false" class="column_name" data-column_name="filosolia"></td>\
                                                                                <td contenteditable="false" class="column_name" data-column_name="fisica" ></td>\
                                                                                <td contenteditable="false" class="column_name" data-column_name="biologia" ></td>\
                                                                                <td contenteditable="false" class="column_name" data-column_name="quimica" ></td>\
                                                                                <td contenteditable="true" class="column_name" data-column_name="matematica" id="' + item.id + '">' + item.matematica + '</td>\
                                                                                <td contenteditable="false" class="column_name" data-column_name="desenho"></td>\
                                                                                <td contenteditable="true" class="column_name" data-column_name="geografia" id="' + item.id + '">' + item.geografia + '</td>\
                                                                                <td contenteditable="true" class="column_name" data-column_name="edfisica" id="' + item.id + '">' + item.edfisica + '</td>\
                                                                                <td contenteditable="true" class="column_name" data-column_name="historia" id="' + item.id + '">' + item.historia + '</td>\
                                                                                <td contenteditable="false" class="column_name" data-column_name="mediaFinalF" id="' + item.id + '">' + item.mediaFinal + '</td>\
                                                                                <td contenteditable="false" class="column_name" data-column_name="situacao" id="' + item.id + '">' + item.situacao + '</td>\
                                                                                <td>\
                                                                                    <a class="btn btn-sm btn-primary" href="/office/certificados/show/'+item.id+'"><i class="fa fa-fw fa-eye"></i></a>\
                                                                                    <button type="button" data-bs-toggle="" data-bs-target="EditCertificado" class="btn btn-success btn-sm edit" id="' + item.id + '"><i class="fa fa-fw fa-edit"></i></button>\
                                                                                    <button type="button" class="btn btn-danger btn-sm delete" id="' + item.id + '"><i class="fa fa-fw fa-trash"></i></button>\
                                                                                </td>\
                                                                        </tr>');
                                                                }

                                                            });

                                                        }
                                                    });
                                                }
                                            }
                                        }
                                    });
                                }

                            }

                        }

                    }
                });
}
