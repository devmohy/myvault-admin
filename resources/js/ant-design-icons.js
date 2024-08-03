import { App } from 'vue';
import * as AntIcons from '@ant-design/icons-vue';

export default function (app) {
  Object.keys(AntIcons).forEach((iconName) => {
    app.component(iconName, AntIcons[iconName]);
  });
}