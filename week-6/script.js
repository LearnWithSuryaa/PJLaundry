// ── Highlight "Profesional" in service title ──
const title = document.querySelector("#service-title");
if (title) {
  const marker = "Profesional";
  const titleText = title.textContent;
  const markerIndex = titleText.indexOf(marker);

  if (markerIndex !== -1) {
    const highlightedWord = document.createElement("span");
    highlightedWord.textContent = marker;
    highlightedWord.className = "rounded bg-[#ffc857] px-1 text-[#106367]";

    title.replaceChildren(
      document.createTextNode(titleText.slice(0, markerIndex)),
      highlightedWord,
      document.createTextNode(titleText.slice(markerIndex + marker.length)),
    );
  }
}

// ── Navbar toggle (mobile) ──
const navToggle = document.getElementById("navToggle");
const navLinks = document.getElementById("navLinks");

const toggleState = (element, state, enabled) => {
  const states = new Set((element.dataset.state || "").split(" ").filter(Boolean));
  if (enabled) states.add(state);
  else states.delete(state);
  element.dataset.state = [...states].join(" ");
};

navToggle.addEventListener("click", () =>
  toggleState(navLinks, "open", navLinks.dataset.state !== "open"),
);
navLinks
  .querySelectorAll("a")
  .forEach((link) =>
    link.addEventListener("click", () => toggleState(navLinks, "open", false)),
  );

// ── Navbar scroll shadow ──
const navbar = document.getElementById("navbar");
window.addEventListener(
  "scroll",
  () => {
    toggleState(navbar, "scrolled", window.scrollY > 20);
  },
  { passive: true },
);


// ── Service tabs ──
const tabBtns = document.querySelectorAll(".tab-btn");
const panels = document.querySelectorAll(".services-panel");

tabBtns.forEach((btn) => {
  btn.addEventListener("click", () => {
    tabBtns.forEach((tab) => {
      toggleState(tab, "active", false);
      tab.setAttribute("aria-selected", "false");
    });
    panels.forEach((panel) => toggleState(panel, "active", false));

    toggleState(btn, "active", true);
    btn.setAttribute("aria-selected", "true");

    const target = document.getElementById(`panel-${btn.dataset.tab}`);
    if (target) toggleState(target, "active", true);

    document
      .querySelectorAll('.services-panel[data-state~="active"] .reveal')
      .forEach((element) => toggleState(element, "visible", true));
  });
});

// ── FAQ Accordion ──
document.querySelectorAll(".faq-question").forEach((btn) => {
  btn.addEventListener("click", () => {
    const item = btn.closest(".faq-item");
    const isOpen = item.dataset.state === "open";

    document.querySelectorAll(".faq-item").forEach((faqItem) => {
      toggleState(faqItem, "open", false);
      faqItem
        .querySelector(".faq-question")
        .setAttribute("aria-expanded", "false");
    });

    if (!isOpen) {
      toggleState(item, "open", true);
      btn.setAttribute("aria-expanded", "true");
    }
  });
});

// ── Scroll Reveal ──
const revealEls = document.querySelectorAll(".reveal");
const io = new IntersectionObserver(
  (entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        toggleState(entry.target, "visible", true);
        io.unobserve(entry.target);
      }
    });
  },
  { threshold: 0.1, rootMargin: "0px 0px -40px 0px" },
);
revealEls.forEach((element) => io.observe(element));
