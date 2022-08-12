

function pdfgenerator() {
     var element = document.querySelector('.schedule-program-day');
     var opt = {
          margin: 1,
          filename: globalURL.sitename + '_' + globalURL.lang + '.pdf',
          //pagebreak: { before: '.schedule-slot-liste' },
          image: { type: 'jpeg', quality: 0.98 },
          html2canvas: { scale: 1 },
          jsPDF: {
               unit: 'mm',
               format: 'a4',
               orientation: 'portrait'

          }
     };

     // New Promise-based usage:
     html2pdf().set(opt).from(element).save();
}