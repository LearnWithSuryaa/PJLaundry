const express = require("express");
const fs = require("node:fs/promises");
const path = require("node:path");

const app = express();
const port = process.env.PORT || 3000;
const servicesFilePath = path.join(__dirname, "data", "services.json");

function sendApiError(response, statusCode, code, message) {
  response.status(statusCode).json({
    error: {
      code,
      message,
    },
  });
}

app.get("/api/services", async (_request, response) => {
  try {
    const fileContents = await fs.readFile(servicesFilePath, "utf8");
    const servicesData = JSON.parse(fileContents);

    if (!Array.isArray(servicesData.services)) {
      sendApiError(
        response,
        500,
        "INVALID_SERVICES_DATA",
        "Format data layanan tidak valid.",
      );
      return;
    }

    response.json({ payload: { services: servicesData.services } });
  } catch (error) {
    console.error("Gagal membaca data layanan:", error);

    if (error instanceof SyntaxError) {
      sendApiError(
        response,
        500,
        "INVALID_SERVICES_JSON",
        "Data layanan tidak dapat diproses.",
      );
      return;
    }

    if (error.code === "ENOENT" || error.code === "EACCES") {
      sendApiError(
        response,
        500,
        "SERVICES_DATA_UNAVAILABLE",
        "Data layanan sedang tidak tersedia.",
      );
      return;
    }

    sendApiError(
      response,
      500,
      "INTERNAL_SERVER_ERROR",
      "Terjadi kesalahan pada server.",
    );
  }
});

app.use(express.static(__dirname));

app.get("/", (_request, response) => {
  response.sendFile(path.join(__dirname, "src", "index.html"));
});

app.listen(port, () => {
  console.log(`PJ Laundry berjalan di http://localhost:${port}`);
});
