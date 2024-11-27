function kurssiEdit(id, nimi, kuvaus, alkupaiva, loppupaiva, opettaja, tila) {

    $('#kurssiEdit-id').val(id);
    $('#kurssiEdit-nimi').val(nimi);
    $('#kurssiEdit-kuvaus').val(kuvaus);
    $('#kurssiEdit-alkupaiva').val(alkupaiva);
    $('#kurssiEdit-loppupaiva').val(loppupaiva);
    $('#kurssiEdit-opettaja').val(opettaja);
    $('#kurssiEdit-tila').val(tila);
 
    $('#kurssiEdit').modal('show');
}

function opettajaEdit(id, etunimi, sukunimi, aine) {

    $('#opettajaEdit-id').val(id);
    $('#opettajaEdit-etunimi').val(etunimi);
    $('#opettajaEdit-sukunimi').val(sukunimi);
    $('#opettajaEdit-aine').val(aine);
 
    $('#opettajaEdit').modal('show');
}

function opiskelijaEdit(id, etunimi, sukunimi, syntymäpäivä, vuosikurssi) {

    $('#opiskelijaEdit-id').val(id);
    $('#opiskelijaEdit-etunimi').val(etunimi);
    $('#opiskelijaEdit-sukunimi').val(sukunimi);
    $('#opiskelijaEdit-syntymäpäivä').val(syntymäpäivä);
    $('#opiskelijaEdit-vuosikurssi').val(vuosikurssi);
 
    $('#opiskelijaEdit').modal('show');
}

function tilaEdit(id, nimi, kapasiteetti) {

    $('#tilaEdit-id').val(id);
    $('#tilaEdit-nimi').val(nimi);
    $('#tilaEdit-kapasiteetti').val(kapasiteetti);
 
    $('#tilaEdit').modal('show');
}