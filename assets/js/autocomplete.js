/**
 * Filtrage en temps réel de la grille de photographies
 * L'autocomplétion met à jour directement le contenu de la page
 */

document.addEventListener("DOMContentLoaded", function () {
  const searchInput = document.querySelector(".header-search-input");
  const mainContent = document.querySelector(".main-content");

  if (!searchInput || !mainContent) return;

  // Sauvegarder le contenu initial
  const initialContent = mainContent.innerHTML;

  let debounceTimer;

  // ============================================
  // ÉCOUTER la saisie
  // ============================================
  searchInput.addEventListener("input", function () {
    const query = this.value.trim();

    clearTimeout(debounceTimer);

    // Si vide, restaurer toutes les photos
    if (query.length < 2) {
      mainContent.innerHTML = initialContent;
      return;
    }

    // Attendre 300ms avant de chercher
    debounceTimer = setTimeout(() => {
      fetchAndDisplay(query);
    }, 300);
  });

  // ============================================
  // FONCTION : Appeler l'API et afficher
  // ============================================
  function fetchAndDisplay(query) {
    fetch(`autocomplete.php?q=${encodeURIComponent(query)}`)
      .then((response) => response.json())
      .then((data) => {
        displayResults(data, query);
      })
      .catch((error) => {
        console.error("Erreur:", error);
      });
  }

  // ============================================
  // FONCTION : Afficher les résultats
  // ============================================
  function displayResults(data, query) {
    const startsWithCount = data.starts_with.length;
    const containsCount = data.contains.length;
    const totalCount = startsWithCount + containsCount;

    // Si aucun résultat
    if (totalCount === 0) {
      mainContent.innerHTML = `
                <div class="search-results">
                    <div class="results-header">
                        <h1 class="results-title">Résultats pour "${query}"</h1>
                        <p class="results-count">0 photographie trouvée</p>
                    </div>
                    <div class="no-results">
                        <p>Aucune photographie ne correspond à votre recherche.</p>
                    </div>
                </div>
            `;
      return;
    }

    // Construire le HTML
    let html = `
            <div class="search-results">
                <div class="results-header">
                    <h1 class="results-title">Résultats pour "${query}"</h1>
                    <p class="results-count">${totalCount} photographie${
      totalCount > 1 ? "s" : ""
    } trouvée${totalCount > 1 ? "s" : ""}</p>
                </div>
        `;

    // Section "Commence par"
    if (startsWithCount > 0) {
      html += `
                <div class="results-section">
                    <h2 class="section-title">Commence par</h2>
                    <div class="results-grid">
                        ${data.starts_with
                          .map((photo) => createPhotoCard(photo))
                          .join("")}
                    </div>
                </div>
            `;
    }

    // Section "Contient"
    if (containsCount > 0) {
      html += `
                <div class="results-section">
                    <h2 class="section-title">Contient</h2>
                    <div class="results-grid">
                        ${data.contains
                          .map((photo) => createPhotoCard(photo))
                          .join("")}
                    </div>
                </div>
            `;
    }

    html += `</div>`;

    mainContent.innerHTML = html;
  }

  // ============================================
  // FONCTION : Créer une carte photo
  // ============================================
  function createPhotoCard(photo) {
    const imageHtml = photo.image_url
      ? `
            <div class="photo-card-image">
                <img src="${photo.image_url}" 
                     alt="${photo.title}"
                     loading="lazy">
            </div>
        `
      : "";

    const yearHtml = photo.year
      ? `<span class="photo-year">${photo.year}</span>`
      : "";
    const locationHtml = photo.location
      ? `<span class="photo-location">${photo.location}</span>`
      : "";

    const descriptionHtml = photo.description
      ? `
            <p class="photo-card-description">
                ${photo.description.substring(0, 150)}...
            </p>
        `
      : "";

    return `
            <article class="photo-card">
                ${imageHtml}
                <div class="photo-card-content">
                    <h2 class="photo-card-title">
                        <a href="element.php?id=${photo.id}">${photo.title}</a>
                    </h2>
                    <p class="photo-card-meta">
                        ${yearHtml}
                        ${locationHtml}
                    </p>
                    ${descriptionHtml}
                </div>
            </article>
        `;
  }
});
