document.addEventListener("DOMContentLoaded", () => {
  const togglePassword = document.querySelector("#togglePassword");
  const password = document.querySelector("#senha");

  const toggleVisibility = (field, toggleBtn) => {
    const type =
      field.getAttribute("type") === "password" ? "text" : "password";
    field.setAttribute("type", type);
    toggleBtn.querySelector("i").classList.toggle("bi-eye");
    toggleBtn.querySelector("i").classList.toggle("bi-eye-slash");
  };

  if (togglePassword) {
    togglePassword.addEventListener("click", () => {
      toggleVisibility(password, togglePassword);
    });
  }

  const form_login = document.querySelector("#form_login");

  if (form_login) {
    form_login.addEventListener("submit", async (e) => {
      e.preventDefault();

      const dadosForm = new FormData(form_login);

      const email = dadosForm.get("email");
      const senha = dadosForm.get("senha");

      if (!email || !senha) {
        Swal.fire({
          text: "Preencha todos os campos.",
          icon: "error",
          confirmButtonColor: "#3085d6",
          confirmButtonText: "Fechar",
        });
        return;
      }

      Swal.fire({
        title: "Processando...",
        timer: 5000,
        timerProgressBar: true,
        didOpen: () => {
          Swal.showLoading();
        },
      });

      try {
        const dados = await fetch("../backend/entrar.php", {
          method: "POST",
          body: dadosForm,
        });

        const resposta = await dados.json();

        if (resposta["status"]) {
          Swal.fire({
            text: resposta["msg"],
            icon: "success",
            confirmButtonColor: "#3085d6",
            confirmButtonText: "Fechar",
          }).then(() => {
            form_login.reset();
            window.location.href = "https://minhasvacinas.online/src/painel/";
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
          text: "Ocorreu um erro ao tentar fazer login. Tente novamente mais tarde.",
          icon: "error",
          confirmButtonColor: "#3085d6",
          confirmButtonText: "Fechar",
        });
        console.error("Erro ao realizar login:", error);
      }
    });
  }
});
