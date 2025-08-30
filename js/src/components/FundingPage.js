import Component from 'flarum/Component';

export default class FundingPage extends Component {
  view() {
    return <div> {app.translator.trans('acmecorp1-money-erc20-funding.funding-page')} </div>;
  }
}