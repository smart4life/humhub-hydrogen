import {
  Platform,
  createNavigation,
  createRouter,
  RootViewModel,
} from "hydrogen-view-sdk";
import downloadSandboxPath from 'hydrogen-view-sdk/download-sandbox.html?url';
import workerPath from 'hydrogen-view-sdk/main.js?url';
import olmWasmPath from '@matrix-org/olm/olm.wasm?url';
import olmJsPath from '@matrix-org/olm/olm.js?url';
import olmLegacyJsPath from '@matrix-org/olm/olm_legacy.js?url';
const assetPaths = {
  downloadSandbox: downloadSandboxPath,
  worker: workerPath,
  olm: {
      wasm: olmWasmPath,
      legacyBundle: olmLegacyJsPath,
      wasmBundle: olmJsPath
  }
};
import { initResizer } from "./resizer";
import "/node_modules/hydrogen-view-sdk/asset-build/assets/theme-element-light.css";
import "/src/style.css";

async function main(matrixServerUrl: string) {
  const app = document.querySelector<HTMLDivElement>('#hydrogen')!
  const config = {
    "push": {
      "appId": "io.element.hydrogen.web",
      "gatewayUrl": "https://matrix.org",
      "applicationServerKey": "BC-gpSdVHEXhvHSHS0AzzWrQoukv2BE7KzpoPO_FfPacqOo3l1pdqz7rSgmB04pZCWaHPz7XRe6fjLaC-WPDopM"
    },
    "defaultHomeServer": matrixServerUrl || "matrix.org",
    "bugReportEndpointUrl": "https://element.io/bugreports/submit"
  };
  const platform = new Platform({container: app, assetPaths, config, options: { development: !import.meta.env.PROD }});

  const navigation = createNavigation();
  platform.setNavigation(navigation);
  const urlRouter = createRouter({
      navigation: navigation,
      history: platform.history
  });
  urlRouter.attach();
  const vm = new RootViewModel({
      platform,
      urlCreator: urlRouter,
      navigation,
  });
  await vm.load();
  platform.createAndMountRootView(vm);

  // Handle chat resizing but will be refactored once implemented in hydrogen view sdk
  initResizer('list', 'LeftPanel');
  setInterval(() => {
    initResizer('conversation', 'RoomView');
  }, 10);
}

declare var humhub : {module: Function};

humhub.module('hydrogen', function (module: { config: { [x: string]: any; }; export: (arg0: { init: () => void; unload: () => void; }) => void; }) {
  var init = function() {
    main(module.config['matrixServerUrl']);
  }

  var unload = function() {
  }

  module.export({
      init: init,
      unload: unload
  });
});
