import { serve } from "https://deno.land/std/http/server.ts";
import { convert } from "https://deno.land/x/office_converter/mod.ts";

serve(async (req) => {
  if (req.method === "POST") {
    const formData = await req.formData();
    const file = formData.get("docx");
    
    if (!(file instanceof Blob)) {
      return new Response("Нужен DOCX файл", { status: 400 });
    }

    const pdfBytes = await convert(file, "pdf");
    return new Response(pdfBytes, {
      headers: {
        "Content-Type": "application/pdf",
        "Content-Disposition": "attachment; filename=converted.pdf"
      }
    });
  }

  return new Response('Отправьте DOCX файл методом POST');
});
