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


const themeStyles = {
  yellow: {
    bar: "before:bg-[#ffc857]",
    icon: "bg-[#fff9d2] text-[#856404]",
  },
  blue: {
    bar: "before:bg-[#8cc0eb]",
    icon: "bg-[#bfddf0] text-[#106367]",
  },
  peach: {
    bar: "before:bg-[#ffebcc]",
    icon: "bg-[#ffebcc] text-[#9a3412]",
  },
  teal: {
    bar: "before:bg-[#106367]",
    icon: "bg-[#e0f2fe] text-[#106367]",
  },
};

// ── Service data and tabs ──
const tabBtns = document.querySelectorAll(".tab-btn");
const panels = document.querySelectorAll(".services-panel");
const servicesStatus = document.getElementById("servicesStatus");

function createServiceCard(service, index) {
  const card = document.createElement("div");

  const theme = themeStyles[service.theme] || themeStyles.yellow;
  const delays = ["", "delay-100", "delay-200", "delay-300", "delay-400"];
  const delayClass = delays[index] || "";

  card.className = `service-card reveal relative flex flex-col justify-between rounded-2xl bg-white p-6 border border-slate-200/80 shadow-[0_4px_20px_rgba(0,0,0,0.05)] hover:shadow-[0_16px_36px_rgba(0,0,0,0.1)] hover:-translate-y-1.5 transition-all duration-300 overflow-hidden before:absolute before:top-0 before:left-0 before:right-0 before:h-1.5 ${theme.bar} data-[state~=visible]:opacity-100 data-[state~=visible]:translate-y-0 opacity-0 translate-y-6 ${delayClass}`;

  const icon = document.createElement("span");
  icon.className = `w-14 h-14 rounded-2xl flex items-center justify-center text-2xl mb-2 ${theme.icon}`;
  icon.textContent = service.icon;

  const name = document.createElement("p");
  name.className = "text-lg font-bold text-slate-900 leading-snug";
  name.textContent = service.name;

  const description = document.createElement("p");
  description.className = "text-sm text-slate-600 leading-relaxed mb-4 flex-1";
  description.textContent = service.description;

  const meta = document.createElement("div");
  meta.className = "flex items-center justify-between gap-2 pt-4 border-t border-slate-100 mt-auto";

  const price = document.createElement("span");
  price.className = "text-base font-extrabold text-[#106367]";
  price.textContent = service.price;

  const duration = document.createElement("span");
  duration.className = "text-xs font-semibold text-slate-600 bg-slate-100 px-3 py-1 rounded-full";
  duration.textContent = service.duration;

  meta.append(price, duration);
  card.append(icon, name, description, meta);
  return card;
}

function renderServices(services) {
  panels.forEach((panel) => {
    const category = panel.id.replace("panel-", "");
    const categoryServices = services.filter(
      (service) => service.category === category,
    );
    panel.replaceChildren(...categoryServices.map(createServiceCard));
  });

  servicesStatus.textContent = `${services.length} layanan berhasil dimuat.`;
  servicesStatus.dataset.state = "success";
  document
    .querySelectorAll('.services-panel[data-state~="active"] .reveal')
    .forEach((element) => toggleState(element, "visible", true));
}

async function loadServices() {
  servicesStatus.textContent = "Mengambil data layanan...";
  servicesStatus.dataset.state = "loading";

  try {
    const response = await fetch("/api/services");
    let responseData;

    try {
      responseData = await response.json();
    } catch {
      throw new Error("Response server tidak valid.");
    }

    if (!response.ok) {
      const errorCode = responseData?.error?.code;
      const errorMessage = responseData?.error?.message;
      const serverError = errorCode
        ? ` (${errorCode})`
        : ` (${response.status})`;

      throw new Error(
        `${errorMessage || "Gagal mengambil data layanan."}${serverError}`,
      );
    }

    if (!Array.isArray(responseData?.payload?.services)) {
      throw new Error("Format data layanan tidak valid");
    }

    renderServices(responseData.payload.services);
  } catch (error) {
    const errorMessage =
      error instanceof Error
        ? error.message
        : "Gagal mengambil data layanan.";
    servicesStatus.textContent = `${errorMessage} Silakan coba lagi.`;
    servicesStatus.dataset.state = "error";
    console.error("Gagal memuat layanan laundry:", error);
  }
}

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

loadServices();
