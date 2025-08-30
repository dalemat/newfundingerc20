// Entry point for JavaScript components in the extension
import { extend } from 'flarum/common/app';

export { default as AdminSettings } from './components/AdminSettings';
export { default as FundingPage } from './components/FundingPage';

// Register components or routes if needed
app.initializers.add('acmecorp-money-erc20-funding', () => {
  // Custom logic (e.g., register components)
});