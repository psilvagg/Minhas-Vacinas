const backToTopButton = document.querySelector(".back-to-top");

window.addEventListener("scroll", () => {
  if (window.scrollY > 300) {
    backToTopButton.style.display = "block";
  } else {
    backToTopButton.style.display = "none";
  }
});

backToTopButton.addEventListener("click", (e) => {
  e.preventDefault();
  window.scrollTo({ top: 0, behavior: "smooth" });
});

DarkReader.setFetchMethod(window.fetch);

DarkReader.enable({
  brightness: 100,
  contrast: 90,
  sepia: 10,
});


DarkReader.disable();

DarkReader.auto({
  brightness: 100,
  contrast: 90,
  sepia: 10,
});

DarkReader.auto(false);

(async () => {
  DarkReader.setFetchMethod(window.fetch);
  
  DarkReader.enable({
    brightness: 100,
    contrast: 90,
    sepia: 10,
  });

  const generatedCSS = await DarkReader.exportGeneratedCSS();
  console.log(generatedCSS); 
})();
