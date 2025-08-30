// Admin panel component for managing extension settings
import Component from 'flarum/Component';

export default class AdminSettings extends Component {
  view() {
    return (
      <div className="Form">
        <h2>{app.translator.trans('acmecorp1-money-erc20-funding.admin.settings-title')}</h2>
        <label>{app.translator.trans('acmecorp1-money-erc20-funding.admin.rpc-endpoint')}</label>
        <input type="text" name="rpc_endpoint" />
        <button type="submit">{app.translator.trans('acmecorp1-money-erc20-funding.admin.save')}</button>
      </div>
    );
  }

  // Add onsubmit handler for saving settings (placeholder)
}