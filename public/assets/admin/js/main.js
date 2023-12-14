function getCookie(name) {
    var match = document.cookie.match(new RegExp(name + '=([^;]+)'));
    return match ? match[1] : undefined;
}

function setCookie(name, value) {
    document.cookie = name + "=" + value + "; path=/";
}

const isMenuClosed = getCookie("Menu");
if (!isMenuClosed) {
    setCookie("Menu", "true");
}


$("#vertical-menu-btn").on("click", function () {
    if (isMenuClosed === "false") {
        setCookie("Menu", "true");
    } else {
        setCookie("Menu", "false");
    }
});

function ShowError(e) {
    var t = JSON.parse(JSON.stringify(e)), o = Object.keys(t)[0], s = t[o];
    if ("error" == o) {
        toastr.options = {
            closeButton: !0,
            debug: !1,
            newestOnTop: !0,
            progressBar: !0,
            positionClass: "toast-bottom-right",
            preventDuplicates: !1,
            showDuration: 300,
            hideDuration: 1e3,
            timeOut: 5e3,
            extendedTimeOut: 1e3,
            showEasing: "swing",
            hideEasing: "linear",
            showMethod: "fadeIn",
            hideMethod: "fadeOut"
        };
        Command:toastr.error(s, "Ошибка")
    } else if ("success" == o) {
        toastr.options = {
            closeButton: !0,
            debug: !1,
            newestOnTop: !0,
            progressBar: !0,
            positionClass: "toast-bottom-right",
            preventDuplicates: !1,
            showDuration: 300,
            hideDuration: 1e3,
            timeOut: 5e3,
            extendedTimeOut: 1e3,
            showEasing: "swing",
            hideEasing: "linear",
            showMethod: "fadeIn",
            hideMethod: "fadeOut"
        };
        Command:toastr.success(s, "Успешно")

    }
}

function CheckError(e) {
    var t = JSON.parse(JSON.stringify(e)), o = Object.keys(t)[0], s = t[o];

    if (o == "error") {
        return false;
    } else if (o == "success") {
        return true;
    }

}

function noConnet(e) {
    if (0 == e.status) {
        toastr.options = {
            closeButton: !0,
            debug: !1,
            newestOnTop: !0,
            progressBar: !0,
            positionClass: "toast-bottom-right",
            preventDuplicates: !1,
            showDuration: 300,
            hideDuration: 1e3,
            timeOut: 5e3,
            extendedTimeOut: 1e3,
            showEasing: "swing",
            hideEasing: "linear",
            showMethod: "fadeIn",
            hideMethod: "fadeOut"
        };
        Command:toastr.error("Отсутствует интернет-соединение! Пожалуйста, проверьте ваше подключение к интернету.")
    } else {
        var t = "Произошла ошибка при выполнении запроса. Статус ошибки: " + e.status;
        toastr.options = {
            closeButton: !0,
            debug: !1,
            newestOnTop: !0,
            progressBar: !0,
            positionClass: "toast-bottom-right",
            preventDuplicates: !1,
            showDuration: 300,
            hideDuration: 1e3,
            timeOut: 5e3,
            extendedTimeOut: 1e3,
            showEasing: "swing",
            hideEasing: "linear",
            showMethod: "fadeIn",
            hideMethod: "fadeOut"
        };
        Command:toastr.error(t)
    }
}


function LocalCheck(type, text) {

    if ("error" == type) {
        toastr.options = {
            closeButton: !0,
            debug: !1,
            newestOnTop: !0,
            progressBar: !0,
            positionClass: "toast-bottom-right",
            preventDuplicates: !1,
            showDuration: 300,
            hideDuration: 1e3,
            timeOut: 5e3,
            extendedTimeOut: 1e3,
            showEasing: "swing",
            hideEasing: "linear",
            showMethod: "fadeIn",
            hideMethod: "fadeOut"
        };
        Command:toastr.error(text, "Ошибка")
    } else if ("success" == type) {
        toastr.options = {
            closeButton: !0,
            debug: !1,
            newestOnTop: !0,
            progressBar: !0,
            positionClass: "toast-bottom-right",
            preventDuplicates: !1,
            showDuration: 300,
            hideDuration: 1e3,
            timeOut: 5e3,
            extendedTimeOut: 1e3,
            showEasing: "swing",
            hideEasing: "linear",
            showMethod: "fadeIn",
            hideMethod: "fadeOut"
        };
        Command:toastr.success(text, "Успешно")

    }
}
