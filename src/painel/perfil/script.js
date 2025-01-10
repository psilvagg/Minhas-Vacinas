document.addEventListener("DOMContentLoaded", function () {
  const sidebarToggle = document.getElementById("sidebarToggle");
  const sidebar = document.querySelector(".sidebar");

  sidebarToggle.addEventListener("click", function () {
    sidebar.classList.toggle("show");
    sidebar.classList.toggle("hide");
  });
});

document.addEventListener("input", function (e) {
  if (e.target.id === "cpf") {
    let value = e.target.value.replace(/\D/g, "");
    if (value.length > 11) value = value.slice(0, 11);
    e.target.value = value
      .replace(/(\d{3})(\d)/, "$1.$2")
      .replace(/(\d{3})(\d)/, "$1.$2")
      .replace(/(\d{3})(\d{1,2})$/, "$1-$2");
  }

  if (e.target.id === "telefone") {
    formatPhoneNumber(e.target);
  }
});

function formatPhoneNumber(input) {
  let phone = input.value.replace(/\D/g, "");
  if (phone.length > 10) {
    phone = phone.replace(/^(\d{2})(\d{5})(\d{4})/, "($1) $2-$3");
  } else if (phone.length > 6) {
    phone = phone.replace(/^(\d{2})(\d{4})(\d{0,4})/, "($1) $2-$3");
  } else if (phone.length > 2) {
    phone = phone.replace(/^(\d{2})(\d{0,4})/, "($1) $2");
  } else {
    phone = phone.replace(/^(\d*)/, "($1");
  }

  input.value = phone;
}

const form_perfil = document.querySelector("#form-perfil");

form_perfil.addEventListener("submit", async (e) => {
  e.preventDefault();

  const dadosForm = new FormData(form_perfil);

  const nome = dadosForm.get("nome");
  const cpf = dadosForm.get("cpf");
  const data_nascimento = dadosForm.get("data_nascimento");
  const telefone = dadosForm.get("telefone");
  const estado = dadosForm.get("estado");
  const genero = dadosForm.get("genero");
  // const cidade = dadosForm.get("cidade");

  if (
    !nome &&
    !cpf &&
    !data_nascimento &&
    !telefone &&
    !estado &&
    !genero //colocar CIDADE AQUII DNVVV, descomentar e add no if no php
  ) {
    Swal.fire({
      text: "Nenhum dado foi alterado.",
      icon: "error",
      confirmButtonColor: "#3085d6",
      confirmButtonText: "Fechar",
      customClass: {
        popup: "my-custom-swal",
      },
    });
    return;
  }

  Swal.fire({
    title: "Processando...",
    html: "Aguarde enquanto estamos atualizando os dados...",
    timerProgressBar: true,
    didOpen: () => {
      Swal.showLoading();
    },
  });

  try {
    const dados = await fetch("../backend/atualizar-dados.php", {
      method: "POST",
      body: dadosForm,
    });

    if (!dados.ok) throw new Error("Erro ao processar a solicitação");

    const resposta = await dados.json();

    if (resposta["status"]) {
      Swal.fire({
        text: resposta["msg"],
        icon: "success",
        confirmButtonColor: "#3085d6",
        confirmButtonText: "Fechar",
      }).then(() => {
        location.reload();
      });
    } else {
      Swal.fire({
        text: resposta["msg"],
        icon: "error",
        confirmButtonColor: "#3085d6",
        confirmButtonText: "Fechar",
      });
    }
  } catch (error) {
    Swal.fire({
      text: "Ocorreu um erro ao tentar atualizar seus dados. Tente novamente mais tarde.",
      icon: "error",
      confirmButtonColor: "#3085d6",
      confirmButtonText: "Fechar",
    });
  }
});

const form_alterar_email = document.querySelector("#form-alterar-email");

form_alterar_email.addEventListener("submit", async (e) => {
  e.preventDefault();

  const dadosForm = new FormData(form_alterar_email);

  const email = dadosForm.get("email");

  if (!email) {
    Swal.fire({
      text: "Nenhum dado foi alterado.",
      icon: "error",
      confirmButtonColor: "#3085d6",
      confirmButtonText: "Fechar",
      customClass: {
        popup: "my-custom-swal",
      },
    });
    return;
  }

  Swal.fire({
    title: "Processando...",
    timerProgressBar: true,
    didOpen: () => {
      Swal.showLoading();
    },
  });

  try {
    const dados = await fetch("../backend/alterar-email.php", {
      method: "POST",
      body: dadosForm,
    });

    if (!dados.ok) throw new Error("Erro ao processar a solicitação");

    const resposta = await dados.json();

    if (resposta["status"]) {
      Swal.fire({
        text: resposta["msg"],
        icon: "success",
        confirmButtonColor: "#3085d6",
        confirmButtonText: "Fechar",
      }).then(() => {
        location.reload();
      });
    } else {
      Swal.fire({
        text: resposta["msg"],
        icon: "error",
        confirmButtonColor: "#3085d6",
        confirmButtonText: "Fechar",
      });
    }
  } catch (error) {
    Swal.fire({
      text: "Ocorreu um erro ao tentar fazer login. Tente novamente mais tarde."
        .$error,
      icon: "error",
      confirmButtonColor: "#3085d6",
      confirmButtonText: "Fechar",
    });
  }
});

$(document).ready(function () {
  $("#state").on("change", function () {
    var selectedState = $(this).val();

    if (selectedState) {
      $.ajax({
        url: "../backend/buscar-cidades.php",
        type: "POST",
        data: { state: selectedState },
        success: function (response) {
          $("#city").html('<option value="">Selecione uma cidade</option>'); // Reseta as opções
          $.each(JSON.parse(response), function (key, value) {
            $("#city").append(
              '<option value="' + value + '">' + value + "</option>"
            );
          });
        },
        error: function () {
          alert("Erro ao buscar cidades.");
        },
      });
    } else {
      $("#city").html('<option value="">Selecione uma cidade</option>'); // Reseta as opções
    }
  });
});
