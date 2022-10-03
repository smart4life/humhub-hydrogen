import elemFetch from "./asyncElemFetcher";
const localStorageResizerLabel = 'resizerSize';
let elemList: {[key: string] : HTMLElement|null} = {};

// Not a good solution, will be deleted once resize will be implemented in hydrogen view sdk
export async function initResizer(identifier: string, elemClassName: string) {
    elemFetch(elemClassName, -1).then((el) => {
        elemList[elemClassName] = el as HTMLElement;
        if (!elemList[elemClassName]?.getElementsByClassName('hydrogen-resizer')[0]) {
            let resizer = document.createElement('div');
            resizer.classList.add("hydrogen-resizer");
            elemList[elemClassName]?.prepend(resizer);
            resizer.addEventListener('mousedown', initResize, false);
            let savedSize = localStorage.getItem(`${identifier}-${localStorageResizerLabel}`);
            if (savedSize !== null) {
                (elemList[elemClassName] as HTMLElement).style.height = savedSize;
            }
        }
    }).catch((e) => {
        console.error(e);
    });

    function initResize() {
      window.addEventListener('mousemove', onMouseDown, false);
      window.addEventListener('mouseup', onMouseUp, false);
    }

    function onMouseDown(e: MouseEvent) {
      document.body.style.userSelect = 'none';
      e.stopPropagation();
      const size = Math.min(Math.max((window.innerHeight - e.clientY), 150), window.innerHeight - 100) + 'px';
      let lElem = elemList[elemClassName];
      if (lElem) {
        lElem.style.height = size;
      }
      localStorage.setItem(`${identifier}-${localStorageResizerLabel}`, size);
    }

    function onMouseUp(e: MouseEvent) {
        document.body.style.userSelect = 'initial';
        e.stopPropagation();
        window.removeEventListener('mousemove', onMouseDown, false);
        window.removeEventListener('mouseup', onMouseUp, false);
    }
};