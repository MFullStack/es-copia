const { DateTime } = require("luxon");

module.exports = function(eleventyConfig) {
  
  // 1. FILTROS (Manejo de fechas con Luxon)
  
  // Filtro para fechas legibles: {{ post.date | postDate(lang) }}
  eleventyConfig.addFilter("postDate", (dateObj, lang = 'es') => {
    if (!dateObj) return "";
    
    // Convertimos a objeto Date si viene como string, luego a Luxon
    const date = (dateObj instanceof Date) ? dateObj : new Date(dateObj);
    
    return DateTime.fromJSDate(date, { zone: 'utc' })
      .setLocale(lang)
      .toLocaleString(DateTime.DATE_MED); 
  });

  // Filtro para SEO (Atributo datetime): {{ post.date | dateIso }}
  eleventyConfig.addFilter("dateIso", (dateObj) => {
    if (!dateObj) return "";
    const date = (dateObj instanceof Date) ? dateObj : new Date(dateObj);
    return DateTime.fromJSDate(date, { zone: 'utc' }).toISODate();
  });

  // 2. COPIA DE ARCHIVOS ESTÁTICOS (Passthrough)
  eleventyConfig.addPassthroughCopy("assets");
  eleventyConfig.addPassthroughCopy("forms");
  eleventyConfig.addPassthroughCopy("vendor");
  eleventyConfig.addPassthroughCopy("./.htaccess");

  // 3. CONFIGURACIÓN DE DIRECTORIOS
  return {
    dir: {
      input: "src",          
      output: "_site",       
      includes: "_includes", 
      data: "_data"          
    },
    markdownTemplateEngine: "njk",
    htmlTemplateEngine: "njk",
    dataTemplateEngine: "njk"
  };
};