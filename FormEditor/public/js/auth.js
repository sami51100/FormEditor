/* Message d'alerte timer */
setTimeout(function () {
	$(".close-message").hide();
}, 4000)

/* Bannière d'alerte */

$('.btn_alert').click(function () {
	$('.alert').addClass("show");
	$('.alert').removeClass("hide");
	$('.alert').addClass("showAlert");
	setTimeout(function () {
		$('.alert').removeClass("show");
		$('.alert').addClass("hide");
	}, 5000);
});
$('.close-btn').click(function () {
	$('.alert').removeClass("show");
	$('.alert').addClass("hide");
});

/* DEBUT Container Panel : Connexion & Inscription */

const sign_in_btn = document.querySelector("#sign-in-btn");
const sign_up_btn = document.querySelector("#sign-up-btn");
const container = document.querySelector(".container");

// sign_up_btn.addEventListener("click", () => {
//   container.classList.add("sign-up-mode");
// });

// sign_in_btn.addEventListener("click", () => {
//   container.classList.remove("sign-up-mode");
// });

/* FIN Container Panel : Connexion & Inscription */

$(document).ready(function () {
	// hide/show password
	$(".icon-wrapper").click(function () {
		$(".toggle-password").toggleClass(".ion-eye ion-more");
		var input = $($(".toggle-password").attr("toggle"));
		if (input.attr("type") == "password") {
			input.attr("type", "text");
		} else {
			input.attr("type", "password");
		}
	});

	// strength validation on keyup-event
	$("#password-field").on("keyup", function () {
		var val = $(this).val(),
			color = testPasswordStrength(val);

		styleStrengthLine(color, val);
	});

	// check password strength
	function testPasswordStrength(value) {
		var strongRegex = new RegExp(
			"^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[=/()%ยง!@#$%^&*])(?=.{8,})"
		),
			mediumRegex = new RegExp(
				"^(((?=.*[a-z])(?=.*[A-Z]))|((?=.*[a-z])(?=.*[0-9]))|((?=.*[A-Z])(?=.*[0-9])))(?=.{6,})"
			);

		if (strongRegex.test(value)) {
			return "green";
		} else if (mediumRegex.test(value)) {
			return "orange";
		} else {
			return "red";
		}
	}

	function styleStrengthLine(color, value) {
		$(".line")
			.removeClass("bg-red bg-orange bg-green")
			.addClass("bg-transparent");

		if (value) {
			if (color === "red") {
				$(".line:nth-child(1)").removeClass("bg-transparent").addClass("bg-red");
			} else if (color === "orange") {
				$(".line:not(:last-of-type)")
					.removeClass("bg-transparent")
					.addClass("bg-orange");
			} else if (color === "green") {
				$(".line").removeClass("bg-transparent").addClass("bg-green");
			}
		}
	}
});
