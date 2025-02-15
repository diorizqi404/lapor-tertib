import "./bootstrap";
import "preline";
import ClipboardJS from "clipboard";
import "preline/dist/helper-clipboard";

// INI BROKKKK SALAH SATU KUNCI BIAR KELOAD ASEK ASEK AWAWAWAWAW
document.addEventListener("livewire:navigated", function () {
    window.HSStaticMethods.autoInit(["overlay"]);
    window.HSStaticMethods.autoInit(["tabs"]);
    window.HSStaticMethods.autoInit(["accordion"]);
    window.HSStaticMethods.autoInit(["dropdown"]);
    window.HSStaticMethods.autoInit(["select"]);
    window.HSStaticMethods.autoInit(["collapse"]);
});
