document.addEventListener("DOMContentLoaded", function () {
  const sidebarToggle = document.getElementById("sidebarToggle");
  const sidebar = document.querySelector(".sidebar");

  sidebarToggle.addEventListener("click", function () {
    sidebar.classList.toggle("show");
    sidebar.classList.toggle("hide");
  });
});

$(function () {
  $('[data-toggle="tooltip"]').tooltip();
});

document.querySelectorAll(".form-excluir-vacina").forEach((form) => {
  form.addEventListener("submit", async (e) => {
    e.preventDefault();

    const dadosForm = new FormData(form);
    const id_vacina = dadosForm.get("id_vac");

    if (!id_vacina) {
      Swal.fire({
        text: "Não foi possível encontrar o campo ID_VACINA.",
        icon: "error",
        confirmButtonColor: "#3085d6",
        confirmButtonText: "Fechar",
      });
      return;
    }

    let loadingSwal = Swal.fire({
      title: "Processando...",
      allowOutsideClick: false,
      didOpen: () => {
        Swal.showLoading();
      },
    });

    try {
      const dados = await fetch("../backend/excluir-vacina.php", {
        method: "POST",
        body: dadosForm,
      });

      const resposta = await dados.json();

      Swal.close();

      if (resposta["status"]) {
        Swal.fire({
          text: resposta["msg"],
          icon: "success",
          confirmButtonColor: "#3085d6",
          confirmButtonText: "Fechar",
        }).then(() => {
          // Você pode remover o item da lista ou recarregar a página após o alerta
          // Exemplo para remover o item do DOM:
          form.closest(".vacina-card").remove();
        });
      } else {
        Swal.fire({
          text: resposta["msg"],
          icon: "error",
          confirmButtonColor: "#3085d6",
          confirmButtonText: "Fechar",
        }).then(() => {
          // Caso de erro, recarregar a página ou apenas dar um feedback visual
          // location.reload();
        });
      }
    } catch (error) {
      Swal.close();

      Swal.fire({
        text: "Ocorreu um erro ao tentar excluir a vacina. Tente novamente mais tarde.",
        icon: "error",
        confirmButtonColor: "#3085d6",
        confirmButtonText: "Fechar",
      });
    }
  });
});
