function getFormData($form){
    var unindexed_array = $form.serializeArray();
    var indexed_array = {};
    $.map(unindexed_array, function(n, i){
        indexed_array[n['name']] = n['value'];
    });

    return indexed_array;
}

function numberFormat(idx){
  return parseInt(idx).toLocaleString(); 
}

function block() {
  var base_url  = window.location.origin;
  $.blockUI({ message : "<img src='"+base_url+"/ci-library/admin-sb2/images/load.gif' width='100px' height='100px' />",  css: { border: 'none', background: 'none' }  });
  //setTimeout(unBlock, 5000); 
}

function unBlock() {
  $.unblockUI();
}

function callpage(id, clsp, nvitem=''){ 
    //alert(id);
    if(id != ""){
    	var base_url  = window.location.origin;
        var dataString = 'content='+id;
        block();
        $.ajax({
            type : "POST",
            url  : id,
            data : dataString,
            success: function(result){
            	    //$("#load-content").hide();
            	    unBlock();
                    $("#body-ctntl").html(result);
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                    
                    //active class a
                    $('a').removeClass('active');
                    $('#'+clsp).addClass('active');
                    //

                    //active class li
                    if(nvitem != ""){
                        $('li').removeClass('active');
                        $('#'+nvitem).addClass('active');
                     }
                    //

                }});
    }
    else{
        alert("Ooops Terjadi Kesalahan, Silahkan Coba Lagi Nanti.");
    }
}


function blockForm(param){
	var base_url  = window.location.origin;
	$('#'+param).block({
       message: "<img src='"+base_url+"/ci-library/admin-sb2/images/load2.gif' width='80px' height='80px' />",  css: { border: 'none', background: 'none' } 
    });
}

function unblockForm(param) {
 	$('#'+param).unblock();
}


function DeleteData(id, url, act, a, li) {
    if (confirm('Are You Sure Delete..?')) {
        $.ajax({
            type: "GET",
            url: url+"/"+act+"/"+id,
            success: function(response) {
                if (response.status == "ok") {
                    callpage(url, a, li);
                    $("#notif-msg").show("slow");
                    $('#notif-msg').fadeIn(2000).html('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <i class="fas fa-trash"></i> '+response.caption+' &nbsp;</div>');  
                    $('#notif-msg').delay(3000).hide(2000);
                } 
                else if (response.status == "post") {
                    //callpage("rental/viewRental", '', '');
                    $("#notif-msg").show("slow");
                    $('#notif-msg').fadeIn(2000).html('<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <i class="fas fa-info"></i> '+response.caption+' &nbsp;</div>');  
                    $('#notif-msg').delay(3000).hide(2000);
                }
                else {
                    console.log('gagal');
                }
            }
        });
    }
    
    return false;
    //alert(url);
}


//get shelf
function getBookshelf(id) {
    $("#getbookshelf").modal('show');
        $.ajax({
            type: "GET",
            url : "bookshelf/viewBookshelf/view/"+id,
            success: function(data) {
                $("#id").val(data.BookshelfID);
                $("#shelfcode").val(data.ShelfCode);
                $("#shelfname").val(data.ShelfName);
                $("#position").val(data.Position);
                $("#desc").val(data.Descripton);
                $("#shelfcode").focus();
            }
        });
    //}
    return false;
}



function BookshelfSave() {
    //e.preventDefault();
    var f_asal  = $("#f_shelf");
    var form    = getFormData(f_asal);

    //idx vlue
    var code    = $("#shelfcode").val();
    var name    = $("#shelfname").val();
    var posn    = $("#position").val();

    if(code == ""){
        $("#notif-bookshelf").show("slow");
        $('#notif-bookshelf').fadeIn(2000).html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <i class="fas fa-info-circle"></i> Please Insert ShelfCode</div>');   
        $('#notif-bookshelf').delay(2000).hide(2000);
        $("#shelfcode").focus();
    }
    else if(name == ""){
        $("#notif-bookshelf").show("slow");
        $('#notif-bookshelf').fadeIn(2000).html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <i class="fas fa-info-circle"></i> Please Insert ShelfName</div>');   
        $('#notif-bookshelf').delay(2000).hide(2000);
        $("#shelfname").focus();
    }
    else if(posn == ""){
        $("#notif-bookshelf").show("slow");
        $('#notif-bookshelf').fadeIn(2000).html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <i class="fas fa-info-circle"></i> Please Insert Position</div>');   
        $('#notif-bookshelf').delay(2000).hide(2000);
        $("#position").focus();
    }
    else{
        blockForm("getbookshelf");
        $.ajax({
            Type            : 'POST',
            url             : 'bookshelf/viewBookshelf/save', 
            secureuri       : false,
            data            : form,
            success : function (data) {
                    var d = JSON.parse(data);
                    if(d.status == 'ok') {
                        $('#getbookshelf').modal('toggle');
                        unblockForm("getbookshelf");
                        callpage("bookshelf/viewBookshelf", 'a-bookshelf', 'li-master');
                        $("#notif-msg").show("slow");
                        $('#notif-msg').fadeIn(2000).html('<div class="alert alert-success"><i class="fas fa-check"></i> '+d.msg+'</div>'); 
                        $('#notif-msg').delay(3000).hide(2000);

                    } 
                    else {
                        $("#notif-bookshelf").show("slow");
                        callpage("bookshelf/viewBookshelf", 'a-bookshelf', 'li-master');
                        $('#notif-bookshelf').html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fas fa-info-circle"></i> Failed To Save</div>');
                        $('#notif-bookshelf').delay(3000).hide(2000);
                    }
            }
        });

    }

    return false;
}


//get category
function getCategory(id) {
    var idnumber = $('#numbering').val();
    $("#addcategory").modal('show');
        $.ajax({
            type: "GET",
            url : "category/viewCategory/view/"+id,
            success: function(data) {
                $("#id").val(data.CategoryCode);
                if(id != 0){
                    $("#catcode").val(data.CategoryCode);
                }
                else{
                    $("#catcode").val(idnumber);
                }
                $("#catname").val(data.CategoryName);
                $("#desc").val(data.Descripton);
                $("#catname").focus();
            }
        });
    //}
    return false;
}



function CategorySave() {
    //e.preventDefault();
    var f_asal  = $("#f_category");
    var form    = getFormData(f_asal);

    //idx vlue
    var catcode = $("#catcode").val();
    var catname = $("#catname").val()

    if(catcode == ""){
        $("#notif-category").show("slow");
        $('#notif-category').fadeIn(2000).html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <i class="fas fa-info-circle"></i> Please Insert ShelfCode</div>');   
        $('#notif-category').delay(2000).hide(2000);
        $("#catcode").focus();
    }
    else if(catname == ""){
        $("#notif-category").show("slow");
        $('#notif-category').fadeIn(2000).html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <i class="fas fa-info-circle"></i> Please Insert ShelfName</div>');   
        $('#notif-category').delay(2000).hide(2000);
        $("#catname").focus();
    }
    else{
        blockForm("addcategory");
        $.ajax({
            Type            : 'POST',
            url             : 'category/viewCategory/save', 
            secureuri       : false,
            data            : form,
            success : function (data) {
                    var d = JSON.parse(data);
                    if(d.status == 'ok') {
                        $('#addcategory').modal('toggle');
                        unblockForm("addcategory");
                        callpage("category/viewCategory", 'a-category', 'li-master');
                        $("#notif-msg").show("slow");
                        $('#notif-msg').fadeIn(2000).html('<div class="alert alert-success"><i class="fas fa-check"></i> '+d.msg+'</div>'); 
                        $('#notif-msg').delay(3000).hide(2000);

                    } 
                    else {
                        $("#notif-category").show("slow");
                        unblockForm("addcategory");
                        callpage("category/viewCategory", 'a-category', 'li-master');
                        $('#notif-category').html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fas fa-info-circle"></i> Failed To Save</div>');
                        $('#notif-category').delay(3000).hide(2000);
                    }
            }
        });

    }

    return false;
}



//get category
function getBook(id) {
    var base_url = window.location.origin;
    var idnumber = $('#numbering').val();
    $("#addbook").modal('show');
        $.ajax({
            type: "GET",
            url : "book/viewBook/view/"+id,
            success: function(data) {
                $("#id").val(data.BookID);
                if(id != 0){
                    $("#bookid").val(data.BookID);
                    $("#viewgambar").html("<img src='"+base_url+"/ci-library/upload/book/"+data.ImageBook+"' width='80' height='90'>");
                    $("#stock").val(data.StockBook);
                }
                else{
                    $("#bookid").val(idnumber);
                    $("#viewgambar").html("");
                    $("#stock").val("1");
                }
                $("#isbn").val(data.Isbn);
                $("#title").val(data.TitleBuku);
                $("#author").val(data.Author);
                $("#pages").val(data.NumberOfPages);
                $("#category").val(data.CategoryCode);
                $("#shelf").val(data.BookshelfID);
                $("#light").val(data.LightDamageCosts);
                $("#heavy").val(data.HeavyDamageCosts);
                $("#lost").val(data.LostCost);
                $("#late").val(data.DailyLateFee);
                $("#isbn").focus();
            }
        });
    //}
    return false;
}



function BookSave() {
    //e.preventDefault();
    var f_asal  = $("#f_book");
    var form    = getFormData(f_asal);

    //idx vlue
    var bookid   = $("#bookid").val();
    var isbn     = $("#isbn").val();
    var title    = $("#title").val();
    var author   = $("#author").val();
    var pages    = $("#pages").val();
    var category = $("#category").val();
    var shelf    = $("#shelf").val();
    var stock    = $("#stock").val();
    var light    = $("#light").val();
    var heavy    = $("#heavy").val();
    var lost     = $("#lost").val();
    var late      = $("#late").val();

    var imgbrh      = $("#userfile").val();
    var idx         = $("#id").val();

    if(bookid == ""){
        $("#notif-book").show("slow");
        $('#notif-book').fadeIn(2000).html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <i class="fas fa-info-circle"></i> Please Insert BookID</div>');   
        $('#notif-book').delay(2000).hide(2000);
        $("#bookid").focus();
    }
    else if(isbn == ""){
        $("#notif-book").show("slow");
        $('#notif-book').fadeIn(2000).html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <i class="fas fa-info-circle"></i> Please Insert Isbn</div>');   
        $('#notif-book').delay(2000).hide(2000);
        $("#isbn").focus();
    }
    else if(title == ""){
        $("#notif-book").show("slow");
        $('#notif-book').fadeIn(2000).html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <i class="fas fa-info-circle"></i> Please Insert TitleBuku</div>');   
        $('#notif-book').delay(2000).hide(2000);
        $("#title").focus();
    }
    else if(author == ""){
        $("#notif-book").show("slow");
        $('#notif-book').fadeIn(2000).html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <i class="fas fa-info-circle"></i> Please Insert Author</div>');   
        $('#notif-book').delay(2000).hide(2000);
        $("#author").focus();
    }
    else if(pages == ""){
        $("#notif-book").show("slow");
        $('#notif-book').fadeIn(2000).html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <i class="fas fa-info-circle"></i> Please Insert NumberOfPages</div>');   
        $('#notif-book').delay(2000).hide(2000);
        $("#pages").focus();
    }
    else if(category == ""){
        $("#notif-book").show("slow");
        $('#notif-book').fadeIn(2000).html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <i class="fas fa-info-circle"></i> Please Insert CategoryCode</div>');   
        $('#notif-book').delay(2000).hide(2000);
        $("#category").focus();
    }
    else if(shelf == ""){
        $("#notif-book").show("slow");
        $('#notif-book').fadeIn(2000).html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <i class="fas fa-info-circle"></i> Please Insert Bookshelf</div>');   
        $('#notif-book').delay(2000).hide(2000);
        $("#shelf").focus();
    }
    else if(stock == ""){
        $("#notif-book").show("slow");
        $('#notif-book').fadeIn(2000).html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <i class="fas fa-info-circle"></i> Please Insert StockBook</div>');   
        $('#notif-book').delay(2000).hide(2000);
        $("#stock").focus();
    }
    else if(light == ""){
        $("#notif-book").show("slow");
        $('#notif-book').fadeIn(2000).html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <i class="fas fa-info-circle"></i> Please Insert LightDamageCosts</div>');   
        $('#notif-book').delay(2000).hide(2000);
        $("#light").focus();
    }
    else if(heavy == ""){
        $("#notif-book").show("slow");
        $('#notif-book').fadeIn(2000).html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <i class="fas fa-info-circle"></i> Please Insert HeavyDamageCosts</div>');   
        $('#notif-book').delay(2000).hide(2000);
        $("#heavy").focus();
    }
    else if(lost == ""){
        $("#notif-book").show("slow");
        $('#notif-book').fadeIn(2000).html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <i class="fas fa-info-circle"></i> Please Insert LostCost</div>');   
        $('#notif-book').delay(2000).hide(2000);
        $("#lost").focus();
    }
    else if(late == ""){
        $("#notif-book").show("slow");
        $('#notif-book').fadeIn(2000).html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <i class="fas fa-info-circle"></i> Please Insert DailyLateFee</div>');   
        $('#notif-book').delay(2000).hide(2000);
        $("#late").focus();
    }
    else if(imgbrh == "" && idx == 0){
        $("#notif-book").show("slow");
        $('#notif-book').fadeIn(2000).html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <i class="fas fa-info-circle"></i> Please Upload Book Image file format .jpg .png</div>'); 
        $('#notif-book').delay(2000).hide(2000);
        $("#userfile").focus();
    }
    else{
        blockForm("addbook");
        $.ajaxFileUpload({
            url             : 'book/viewBook/save', 
            secureuri       : false,
            fileElementId   : 'userfile',
            data            : form,
            dataType        : 'jsonp',
            contentType     : 'text/javascript',
            success : function (data) {
                    var d = JSON.parse(data);
                    if(d.status == 'ok') {
                        $('#addbook').modal('toggle');
                        unblockForm("addbook");
                        callpage("book/viewBook", 'a-book', 'li-master');
                        $("#notif-msg").show("slow");
                        $('#notif-msg').fadeIn(2000).html('<div class="alert alert-success"><i class="fas fa-check"></i> '+d.msg+'</div>'); 
                        $('#notif-msg').delay(3000).hide(2000);

                    } 
                    else {
                        $("#notif-book").show("slow");
                        unblockForm("addbook");
                        callpage("book/viewBook", 'a-book', 'li-master');
                        $('#notif-book').html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fas fa-info-circle"></i> Failed To Save</div>');
                        $('#notif-book').delay(3000).hide(2000);
                    }
            }
        });

    }

    return false;
}


//get customer
function getBorrowers(id) {
    $("#addborrowers").modal('show');
    //if(id > 0){
        var base_url = window.location.origin;
        var idcust   = $('#numberingcust').val();
        //alert(idcust);
        $.ajax({
            type: "GET",
            url : "borrowers/viewBorrowers/view/"+id,
            success: function(data) {
                $("#id").val(data.BorrowerID);
                if(id != 0){
                    $("#custid").val(data.BorrowerID);
                }
                else{
                    $("#custid").val(idcust);   
                }
                $("#custname").val(data.CustomerName);
                $("#mobphone").val(data.MobilePhone);
                $("#homephone").val(data.HomePhone);
                $("#identityid").val(data.IdentityID);
                $("#addres").val(data.Address);
                $("#email").val(data.Email);
                $("#birth").val(data.DateOfBirth);
                if(data.IsActive == "N"){
                    $("#viewinfo").html('<font color="red"><i style="font-size: 12px;">*Borrowers is deleted</i></font>');
                }
                else{
                    $("#viewinfo").html('');
                }
                //$("#userfile").val(data.OrderImage);

                if(id != 0){
                    $("#viewgambar").html("<img src='"+base_url+"/ci-library/upload/borrowers/"+data.BorrowerImage+"' width='80' height='90'>");
                    $("#gender").val(data.Gender);
                }
                else{
                    $("#viewgambar").html("");
                    $("#gender").val("M");
                }

                $("#custname").focus();
            }
        });
    //}
    return false;
}


//customer save
function BorrowerSave() {
    //e.preventDefault();
    var f_asal  = $("#f_borrowers");
    var form    = getFormData(f_asal);

    //idx vlue
    var custid      = $("#custid").val();
    var custname    = $("#custname").val();
    var mobphone    = $("#mobphone").val();
    var homephone   = $("#homephone").val();
    var identityid  = $("#identityid").val();
    var addres      = $("#addres").val();
    var gender      = $("#gender").val();
    var email       = $("#email").val();
    var birth       = $("#birth").val();

    var imgbrh      = $("#userfile").val();
    var idx         = $("#id").val();

    if(custid == ""){
        $("#notif-borrowers").show("slow");
        $('#notif-borrowers').fadeIn(2000).html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <i class="fas fa-info-circle"></i> Please Insert Customer ID</div>');   
        $('#notif-borrowers').delay(2000).hide(2000);
        $("#custid").focus();
    }
    else if(custname == ""){
        $("#notif-borrowers").show("slow");
        $('#notif-borrowers').fadeIn(2000).html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <i class="fas fa-info-circle"></i> Please Insert CustomerName</div>');    
        $('#notif-borrowers').delay(2000).hide(2000);
        $("#custname").focus();
    }
    else if(mobphone == ""){
        $("#notif-borrowers").show("slow");
        $('#notif-borrowers').fadeIn(2000).html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <i class="fas fa-info-circle"></i> Please Insert MobilePhone</div>');  
        $('#notif-borrowers').delay(2000).hide(2000);
        $("#mobphone").focus();
    }
    else if(homephone == ""){
        $("#notif-borrowers").show("slow");
        $('#notif-borrowers').fadeIn(2000).html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <i class="fas fa-info-circle"></i> Please Insert HomePhone</div>');    
        $('#notif-borrowers').delay(2000).hide(2000);
        $("#homephone").focus();
    }
    else if(identityid == ""){
        $("#notif-borrowers").show("slow");
        $('#notif-borrowers').fadeIn(2000).html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <i class="fas fa-info-circle"></i> Please Insert IdentityID</div>');    
        $('#notif-borrowers').delay(2000).hide(2000);
        $("#identityid").focus();
    }
    else if(addres == ""){
        $("#notif-borrowers").show("slow");
        $('#notif-borrowers').fadeIn(2000).html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <i class="fas fa-info-circle"></i> Please Insert Address</div>');    
        $('#notif-borrowers').delay(2000).hide(2000);
        $("#addres").focus();
    }
    else if(email == ""){
        $("#notif-borrowers").show("slow");
        $('#notif-borrowers').fadeIn(2000).html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <i class="fas fa-info-circle"></i> Please Insert Email</div>');    
        $('#notif-borrowers').delay(2000).hide(2000);
        $("#email").focus();
    }
    else if(birth == ""){
        $("#notif-borrowers").show("slow");
        $('#notif-borrowers').fadeIn(2000).html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <i class="fas fa-info-circle"></i> Please Insert DateOfBirth</div>');    
        $('#notif-borrowers').delay(2000).hide(2000);
        $("#birth").focus();
    }
    else if(imgbrh == "" && idx == 0){
        $("#notif-borrowers").show("slow");
        $('#notif-borrowers').fadeIn(2000).html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <i class="fas fa-info-circle"></i> Please Upload Customer Image file format .jpg .png</div>'); 
        $('#notif-borrowers').delay(2000).hide(2000);
        $("#userfile").focus();
    }
    else{
        blockForm("addborrowers");
        $.ajaxFileUpload({
            url             : 'borrowers/viewBorrowers/save', 
            secureuri       : false,
            fileElementId   : 'userfile',
            data            : form,
            dataType        : 'jsonp',
            contentType     : 'text/javascript',
            success : function (data) {
                    var d = JSON.parse(data);
                    if(d.status == 'ok') {
                        //$('#konfirmasi').html('<div class="alert alert-success">'+d.msg+'</div>');            
                        //window.location.assign("tampil_service");
                        $('#addborrowers').modal('toggle');
                        unblockForm("addborrowers");
                        //$('#getserviceimage').modal('hide');
                        callpage("borrowers/viewBorrowers", '', '');
                        $("#notif-msg").show("slow");
                        $('#notif-msg').fadeIn(2000).html('<div class="alert alert-success"><i class="fas fa-check"></i> '+d.msg+'</div>'); 
                        $('#notif-msg').delay(3000).hide(2000);

                    } 
                    else {
                        //$('#konfirmasi').html('<div class="alert alert-danger">Failed To Save</div>');
                        $("#notif-borrowers").show("slow");
                        unblockForm("addborrowers");
                        $('#notif-borrowers').html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fas fa-info-circle"></i> '+d.msg+'</div>');
                        $('#notif-borrowers').delay(3000).hide(2000);
                        $("#"+d.focus).focus();
                    }

                    
            }
        });

    }
    return false;
}



//get borrowing
function getBorrowing(id) {
    var idnumber = $('#numbering').val();
    $("#addborrowing").modal('show');
        $.ajax({
            type: "GET",
            url : "borrowing/viewBorrowing/view/"+id,
            success: function(data) {
                $("#id").val(data.BorrowingID);
                if(id != 0){
                    $("#borrowing").val(data.BorrowingID);
                    $("#stock").val(data.StockBook);
                    $("#totalinfo").html("<font color='red'><i style='font-size: 12px;'>" + data.StockBook+ " Book Available </i></font>");
                }
                else{
                    $("#borrowing").val(idnumber);
                }
                $("#borrower").val(data.BorrowerID);
                $("#borrowername").val(data.CustomerName);
                $("#bookid").val(data.BookID);
                $("#bookname").val(data.TitleBuku);
                $("#startdate").val(data.StartDate);
                $("#enddate").val(data.EndDate);
                $("#total").val(data.TotalBook);
                $("#desc").val(data.Description);
                $("#borrower").focus();
            }
        });
    //}
    return false;
}



function BorrowingSave() {
    //e.preventDefault();
    var f_asal  = $("#f_borrowing");
    var form    = getFormData(f_asal);

    //idx vlue
    var borrowing = $("#borrowing").val();
    var borrower  = $("#borrower").val();
    var bookid    = $("#bookid").val();
    var sdate     = $("#startdate").val();
    var edate     = $("#enddate").val();
    var total     = $("#total").val();

    if(borrowing == ""){
        $("#notif-borrowing").show("slow");
        $('#notif-borrowing').fadeIn(2000).html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <i class="fas fa-info-circle"></i> Please Insert BorrowingID</div>');   
        $('#notif-borrowing').delay(2000).hide(2000);
        $("#borrowing").focus();
    }
    else if(borrower == ""){
        $("#notif-borrowing").show("slow");
        $('#notif-borrowing').fadeIn(2000).html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <i class="fas fa-info-circle"></i> Please Insert BorrowerID</div>');   
        $('#notif-borrowing').delay(2000).hide(2000);
        $("#borrower").focus();
    }
    else if(bookid == ""){
        $("#notif-borrowing").show("slow");
        $('#notif-borrowing').fadeIn(2000).html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <i class="fas fa-info-circle"></i> Please Insert BookID</div>');   
        $('#notif-borrowing').delay(2000).hide(2000);
        $("#bookid").focus();
    }
    else if(sdate == ""){
        $("#notif-borrowing").show("slow");
        $('#notif-borrowing').fadeIn(2000).html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <i class="fas fa-info-circle"></i> Please Insert StartDate</div>');   
        $('#notif-borrowing').delay(2000).hide(2000);
        $("#startdate").focus();
    }
    else if(edate == ""){
        $("#notif-borrowing").show("slow");
        $('#notif-borrowing').fadeIn(2000).html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <i class="fas fa-info-circle"></i> Please Insert EndDate</div>');   
        $('#notif-borrowing').delay(2000).hide(2000);
        $("#enddate").focus();
    }
    else if(total == ""){
        $("#notif-borrowing").show("slow");
        $('#notif-borrowing').fadeIn(2000).html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <i class="fas fa-info-circle"></i> Please Insert Total Book</div>');   
        $('#notif-borrowing').delay(2000).hide(2000);
        $("#total").focus();
    }
    else{
        blockForm("addborrowing");
        $.ajax({
            Type            : 'POST',
            url             : 'borrowing/viewBorrowing/save', 
            secureuri       : false,
            data            : form,
            success : function (data) {
                    var d = JSON.parse(data);
                    if(d.status == 'ok') {
                        $('#addborrowing').modal('toggle');
                        unblockForm("addborrowing");
                        callpage("borrowing/viewBorrowing", 'a-borrowing', 'li-transaction');
                        $("#notif-msg").show("slow");
                        $('#notif-msg').fadeIn(2000).html('<div class="alert alert-success"><i class="fas fa-check"></i> '+d.msg+'</div>'); 
                        $('#notif-msg').delay(3000).hide(2000);

                    } 
                    else if (d.status == "post") {
                        $('#addborrowing').modal('toggle');
                        unblockForm("addborrowing");
                        callpage("borrowing/viewBorrowing", 'a-borrowing', 'li-transaction');
                        $("#notif-msg").show("slow");
                        $('#notif-msg').fadeIn(2000).html('<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <i class="fas fa-info"></i> '+d.msg+' &nbsp;</div>');  
                        $('#notif-msg').delay(3000).hide(2000);
                    }
                    else {
                        $("#notif-borrowing").show("slow");
                        unblockForm("addborrowing");
                        callpage("borrowing/viewBorrowing", 'a-borrowing', 'li-transaction');
                        $('#notif-borrowing').html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fas fa-info-circle"></i> Failed To Save</div>');
                        $('#notif-borrowing').delay(3000).hide(2000);
                    }
            }
        });

    }

    return false;
}



//get ReturnBook
function getReturnBook(id) {
    var idnumber = $('#numbering').val();
    $("#addreturnbook").modal('show');
        $.ajax({
            type: "GET",
            url : "ReturnBook/viewReturnbook/view/"+id,
            success: function(data) {
                $("#id").val(data.ReturnBookID);
                if(id != 0){
                    $("#return").val(data.ReturnBookID);
                    $("#idlight").val(data.LightDamageCosts);
                    $("#idheavy").val(data.HeavyDamageCosts);
                    $("#idlost").val(data.LostCost);
                    $("#idlate").val(data.DailyLateFee);
                    $("#stock").val(data.TotalBook);
                    $("#late").val(data.LateCharge);
                    $("#amount").val(data.DamageCost);
                    $("#cost").val(data.TotalCost);
                    $("#totalinfo").html('<font color="red"><i style="font-size: 12px;">* '+  data.TotalBook+ ' Borrowing Book</i></font>');
                }
                else{
                    $("#return").val(idnumber);
                    $("#idlight").val("0");
                    $("#idheavy").val("0");
                    $("#idlost").val("0");
                    $("#idlate").val("0");
                    $("#stock").val("0");
                    $("#late").val("0");
                    $("#amount").val("0");
                    $("#cost").val("0");
                    $("#totalinfo").html('');
                }
                $("#borrowing").val(data.BorrowingID);
                $("#borrower").val(data.BorrowerID);
                $("#borrowername").val(data.CustomerName);
                $("#bookid").val(data.BookID);
                $("#bookname").val(data.TitleBuku);
                $("#startdate").val(data.StartDate);
                $("#enddate").val(data.EndDate);
                $("#total").val(data.TotalBook);
                $("#returndate").val(data.ReturnDate);
                $("#damage").val(data.DamageOrLostBook);
                $("#desc").val(data.Description);
                $("#borrower").focus();
            }
        });
    //}
    return false;
}



function ReturnBookSave() {
    //e.preventDefault();
    var f_asal  = $("#f_returnbook");
    var form    = getFormData(f_asal);

    //idx vlue
    var returnbook= $("#return").val();
    var borrowing = $("#borrowing").val();
    var borrower  = $("#borrower").val();
    var late      = $("#late").val();
    var returndate= $("#returndate").val();
    var total     = $("#total").val();

    if(returnbook == ""){
        $("#notif-returnbook").show("slow");
        $('#notif-returnbook').fadeIn(2000).html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <i class="fas fa-info-circle"></i> Please Insert ReturnBookID</div>');   
        $('#notif-returnbook').delay(2000).hide(2000);
        $("#return").focus();
    }
    else if(borrowing == ""){
        $("#notif-returnbook").show("slow");
        $('#notif-returnbook').fadeIn(2000).html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <i class="fas fa-info-circle"></i> Please Insert BorrowingID</div>');   
        $('#notif-returnbook').delay(2000).hide(2000);
        $("#borrowing").focus();
    }
    else if(borrower == ""){
        $("#notif-returnbook").show("slow");
        $('#notif-returnbook').fadeIn(2000).html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <i class="fas fa-info-circle"></i> Please Insert BorrowerID</div>');   
        $('#notif-returnbook').delay(2000).hide(2000);
        $("#borrower").focus();
    }
    else if(late == ""){
        $("#notif-returnbook").show("slow");
        $('#notif-returnbook').fadeIn(2000).html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <i class="fas fa-info-circle"></i> Please Insert LateCharge</div>');   
        $('#notif-returnbook').delay(2000).hide(2000);
        $("#late").focus();
    }
    else if(returndate == ""){
        $("#notif-returnbook").show("slow");
        $('#notif-returnbook').fadeIn(2000).html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <i class="fas fa-info-circle"></i> Please Insert ReturnDate</div>');   
        $('#notif-returnbook').delay(2000).hide(2000);
        $("#returndate").focus();
    }
    else if(total == ""){
        $("#notif-returnbook").show("slow");
        $('#notif-returnbook').fadeIn(2000).html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <i class="fas fa-info-circle"></i> Please Insert Total Book</div>');   
        $('#notif-returnbook').delay(2000).hide(2000);
        $("#total").focus();
    }
    else{
        blockForm("addreturnbook");
        $.ajax({
            Type            : 'POST',
            url             : 'returnbook/viewReturnbook/save', 
            secureuri       : false,
            data            : form,
            success : function (data) {
                    var d = JSON.parse(data);
                    if(d.status == 'ok') {
                        $('#addreturnbook').modal('toggle');
                        unblockForm("addreturnbook");
                        callpage("returnbook/viewReturnbook", 'a-returnbook', 'li-transaction');
                        $("#notif-msg").show("slow");
                        $('#notif-msg').fadeIn(2000).html('<div class="alert alert-success"><i class="fas fa-check"></i> '+d.msg+'</div>'); 
                        $('#notif-msg').delay(3000).hide(2000);

                    } 
                    else if (d.status == "post") {
                        $('#addreturnbook').modal('toggle');
                        unblockForm("addreturnbook");
                        callpage("returnbook/viewReturnbook", 'a-returnbook', 'li-transaction');
                        $("#notif-msg").show("slow");
                        $('#notif-msg').fadeIn(2000).html('<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <i class="fas fa-info"></i> '+d.msg+' &nbsp;</div>');  
                        $('#notif-msg').delay(3000).hide(2000);
                    }
                    else {
                        $("#notif-returnbook").show("slow");
                        unblockForm("addreturnbook");
                        callpage("returnbook/viewReturnbook", 'a-returnbook', 'li-transaction');
                        $('#notif-returnbook').html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fas fa-info-circle"></i> Failed To Save</div>');
                        $('#notif-returnbook').delay(3000).hide(2000);
                    }
            }
        });

    }

    return false;
}



function setPostData(id, uri, act, a, li) {
    if (confirm('Are You Sure Post Data '+id+' ..?')) {
        $.ajax({
            type: "GET",
            url: uri+"/"+act+"/"+id,
            success: function(response) {
                if (response.status == "ok") {
                    callpage(uri, a, li);
                    $("#notif-msg").show("slow");
                    $('#notif-msg').fadeIn(2000).html('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <i class="fas fa-check"></i> '+response.caption+' &nbsp;</div>');  
                    $('#notif-msg').delay(3000).hide(2000);
                }
                else if (response.status == "post") {
                    //callpage("rental/viewRental", '', '');
                    $("#notif-msg").show("slow");
                    $('#notif-msg').fadeIn(2000).html('<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <i class="fas fa-info"></i> '+response.caption+' &nbsp;</div>');  
                    $('#notif-msg').delay(3000).hide(2000);
                }
                 else if (response.status == "failed") {
                    //callpage("rental/viewRental", '', '');
                    $("#notif-msg").show("slow");
                    $('#notif-msg').fadeIn(2000).html('<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <i class="fas fa-info"></i> '+response.caption+' &nbsp;</div>');  
                    $('#notif-msg').delay(3000).hide(2000);
                }
                 else {
                    console.log('gagal');
                }
            }
        });
    }
    
    return false;
}





function UploadImage() {
    var f_asal  = $("#f_admin");
    var form    = getFormData(f_asal);

        $.ajaxFileUpload({
            url             : 'profile/viewProfile/save', 
            secureuri       : false,
            fileElementId   : 'userfile',
            data            : form,
            dataType        : 'jsonp',
            contentType     : 'text/javascript',
            success : function (data) {
                    var d = JSON.parse(data);
                    if(d.status == 'ok') {
                        //$('#konfirmasi').html('<div class="alert alert-success">'+d.msg+'</div>');            
                        //window.location.assign("tampil_service");
                        //$('#getcaption').modal('toggle');
                        //$('#getserviceimage').modal('hide');
                        callpage("profile/viewProfile", '', '');
                        $("#notif-msg").show("slow");
                        $('#notif-msg').fadeIn(2000).html('<div class="alert alert-success"><i class="fas fa-check"></i> '+d.msg+'</div>'); 
                        $('#notif-msg').delay(3000).hide(2000);

                    } 
                    else {
                        //$('#konfirmasi').html('<div class="alert alert-danger">Failed To Save</div>');
                        $("#notif-admin").show("slow");
                        $('#notif-admin').html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fas fa-info-circle"></i> '+d.msg+'</div>');
                        $('#notif-admin').delay(3000).hide(2000);
                        $("#"+d.focus).focus();
                    }

            }
        });

    return false;
}


// function setLateChargeRent(str, edt){
//     alert(daysDifference(str, edt));
//     return daysDifference(str, edt);
// }


// function daysDifference(d0, d1) {
//   var diff = new Date(+d1).setHours(12) - new Date(+d0).setHours(12);
//   return Math.round(diff/8.64e7);
// }



//report
function ReportcarSearch() {
    //e.preventDefault();
    var f_asal  = $("#r_car");
    var form    = getFormData(f_asal);

    //idx vlue
    var carname = $("#carname").val();
    var effdate = $("#effdate").val();
    var merkid  = $("#merkid").val();
   
    if(effdate == ""){
        $("#notif-rpt").show("slow");
        $('#notif-rpt').fadeIn(2000).html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <i class="fas fa-info-circle"></i> Please Insert Effective Date</div>');   
        $('#notif-rpt').delay(2000).hide(2000);
        $("#effdate").focus();
    }
    // else if(merkid == ""){
    //     $("#notif-rpt").show("slow");
    //     $('#notif-rpt').fadeIn(2000).html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <i class="fas fa-info-circle"></i> Please Insert MerkID</div>');   
    //     $('#notif-rpt').delay(2000).hide(2000);
    //     $("#merkid").focus();
    // }
    else{
        block();
        $.ajax({
            url             : 'reportcar/viewReportCar/view', 
            type            : "POST",
            data            : form,
            success : function (result) {
                //alert("ok"); 
                $("#content-rpt").html(result);
                unBlock();       
            }
        });

    }
    return false;
}


function ReportstockSearch() {
    //e.preventDefault();
    var f_asal  = $("#r_rent");
    var form    = getFormData(f_asal);

        block();
        $.ajax({
            url             : 'reportstock/viewReportstock/view', 
            type            : "POST",
            data            : form,
            success : function (result) {
                //alert("ok"); 
                if(result){
                    $("#content-rpt").html(result);
                    unBlock();    
                }
                else{
                    $("#notif-msg").show("slow");
                    unBlock();
                    $("#content-rpt").html("");
                    $('#notif-msg').html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <i class="fas fa-info-circle"></i> Record Not Found </div>');
                    $('#notif-msg').delay(3000).hide(2000);
                    $("#bookid").focus();
                }   
            }
          
        });

    return false;
}




function ReportSearch(frm, param) {
    //e.preventDefault();
    var f_asal  = $("#"+frm);
    var form    = getFormData(f_asal);

        block();
        $.ajax({
            url             : param, 
            type            : "POST",
            data            : form,
            success : function (result) {
                //alert("ok"); 
                if(result){
                    $("#content-rpt").html(result);
                    unBlock();    
                }
                else{
                    $("#notif-msg").show("slow");
                    unBlock();
                    $("#content-rpt").html("");
                    $('#notif-msg').html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <i class="fas fa-info-circle"></i> Record Not Found </div>');
                    $('#notif-msg').delay(3000).hide(2000);
                    $("#bookid").focus();
                }   
            }
          
        });

    return false;
}




//branch maps
function getUser(id) {
    $("#adduser").modal('show');
    //if(id > 0){
        //var base_url = window.location.origin;
        var d = new Date(),
                month = '' + (d.getMonth() + 1),
                day   = '' + d.getDate(),
                year  = d.getFullYear();
        
            if (month.length < 2) {
                month = '0' + month;
            }
            if (day.length < 2) {
                day   = '0' + day;
            }
        var todaydate= year+"-"+month+"-"+day;
            
        $.ajax({
            type: "GET",
            url : "user/viewUser/view/"+id,
            success: function(data) {
                $("#id").val(data.AdminID);
                $("#nama").val(data.AdminName);
                if(id != 0){
                    $("#birthday").val(data.DateOfBirth);
                    $("#supuser").val(data.SuperUser);
                }
                else{
                    $("#birthday").val(todaydate);
                    $("#supuser").val("N");
                }
                $("#email").val(data.email);
                $("#username").val(data.UserName);
                $("#nama").focus();
            }
        });
    //}
    return false;
}



function UserSave() {
    //e.preventDefault();
    var f_asal  = $("#f_user");
    var form    = getFormData(f_asal);

    //idx vlue
    var adminnm     = $("#nama").val();
    var birthday    = $("#birthday").val();
    var email       = $("#email").val();
    var username    = $("#username").val();
    var password    = $("#password").val();
    var rpassword   = $("#repassword").val();

    if(adminnm == ""){
        $("#notif-user").show("slow");
        $('#notif-user').fadeIn(2000).html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <i class="fas fa-info-circle"></i> Please Insert Name</div>'); 
        $('#notif-user').delay(2000).hide(2000);
        $("#nama").focus();
    }
    else if(birthday == ""){
        $("#notif-user").show("slow");
        $('#notif-user').fadeIn(2000).html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <i class="fas fa-info-circle"></i> Please Insert Birthday</div>'); 
        $('#notif-user').delay(2000).hide(2000);
        $("#birthday").focus();
    }
    else if(email == ""){
        $("#notif-user").show("slow");
        $('#notif-user').fadeIn(2000).html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <i class="fas fa-info-circle"></i> Please Insert Email</div>');    
        $('#notif-user').delay(2000).hide(2000);
        $("#email").focus();
    }
    else if(username == ""){
        $("#notif-user").show("slow");
        $('#notif-user').fadeIn(2000).html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <i class="fas fa-info-circle"></i> Please Insert UserName</div>'); 
        $('#notif-user').delay(2000).hide(2000);
        $("#username").focus();
    }
    else if(password == ""){
        $("#notif-user").show("slow");
        $('#notif-user').fadeIn(2000).html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <i class="fas fa-info-circle"></i> Please Insert password</div>'); 
        $('#notif-user').delay(2000).hide(2000);
        $("#password").focus();
    }
    else if(rpassword == ""){
        $("#notif-user").show("slow");
        $('#notif-user').fadeIn(2000).html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <i class="fas fa-info-circle"></i> Please Insert Re password</div>');  
        $('#notif-user').delay(2000).hide(2000);
        $("#repassword").focus();
    }
    else{
        blockForm("adduser");
        $.ajaxFileUpload({
            url             : 'user/viewUser/save', 
            secureuri       : false,
            fileElementId   : 'userfile',
            data            : form,
            dataType        : 'jsonp',
            contentType     : 'text/javascript',
            success : function (data) {
                    var d = JSON.parse(data);
                    if(d.status == 'ok') {
                        //$('#konfirmasi').html('<div class="alert alert-success">'+d.msg+'</div>');            
                        //window.location.assign("tampil_service");

                        $('#adduser').modal('toggle');
                        unblockForm("adduser");
                        //$('#getserviceimage').modal('hide');
                        callpage("user/viewUser", '', '');
                        $("#notif-msg").show("slow");
                        $('#notif-msg').fadeIn(2000).html('<div class="alert alert-success"><i class="fas fa-check"></i> '+d.msg+'</div>'); 
                        $('#notif-msg').delay(3000).hide(2000);

                    } 
                    else {
                        if(d.focus == "repassword"){
                            $("#notif-user").show("slow");
                            unblockForm("adduser");
                            $('#notif-user').html('<div class="alert alert-danger">'+d.msg+'</div>');
                            $('#notif-user').delay(3000).hide(2000);
                            $("#repassword").focus();
                        }
                        else if(d.focus == "username"){
                            $("#notif-user").show("slow");
                            unblockForm("adduser");
                            $('#notif-user').html('<div class="alert alert-danger">'+d.msg+'</div>');
                            $('#notif-user').delay(3000).hide(2000);
                            $("#username").focus();
                        }
                        else{
                            //$('#konfirmasi').html('<div class="alert alert-danger">'+d.msg+'</div>');
                            $("#notif-user").show("slow");
                            unblockForm("adduser");
                            $('#notif-user').html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fas fa-info-circle"></i> Failed To Save</div>');
                            $('#notif-user').delay(3000).hide(2000);
                        }
                    }
            }
        });
    }

    return false;
}


function UserDelete(id) {
    if (confirm('Are You Sure Delete..?')) {
        $.ajax({
            type: "GET",
            url: "user/viewUser/delete/"+id,
            success: function(response) {
                if (response.status == "ok") {
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                    callpage("user/viewUser", '', '');
                    $("#notif-msg").show("slow");
                    $('#notif-msg').fadeIn(2000).html('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <i class="fas fa-trash"></i> '+response.caption+' &nbsp;</div>');  
                    $('#notif-msg').delay(3000).hide(2000);


                } else {
                    console.log('gagal');
                }
            }
        });
    }
    
    return false;
}