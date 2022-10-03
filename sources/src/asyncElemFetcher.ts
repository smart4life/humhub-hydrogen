let isFirstLoadInterval: {[key: string]: number} = {};
let nbTry = 0;

export default function(elemClassName: string, maxTry: number) {
  return new Promise((resolve, reject) => {
    let elem = document.getElementsByClassName(elemClassName)[0];
    if (elem) {
      clearInterval(isFirstLoadInterval[elemClassName]);
      resolve(elem);
    } else {
      isFirstLoadInterval[elemClassName] = setInterval(() => {
          let elem = document.getElementsByClassName(elemClassName)[0];
          if (elem) {
            clearInterval(isFirstLoadInterval[elemClassName]);
            resolve(elem);
          } else {
            nbTry++;
          }
          if (maxTry !== -1 && nbTry >= maxTry) {
            clearInterval(isFirstLoadInterval[elemClassName]);
            reject(`Can't find elem with className ${elemClassName}`);
          }
        }, 100);
    }
  });
}
