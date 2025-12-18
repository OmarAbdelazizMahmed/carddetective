# GitHub Release Guide

## Steps to Create a New Release

### 1. **Update Version Number** (if needed)

Since you have tags v1.0.0 through v1.0.3, the next version should be:
- **v1.0.4** for a patch release (bug fixes)
- **v1.1.0** for a minor release (new features, refactoring)
- **v2.0.0** for a major release (breaking changes)

Given the recent changes (design patterns, PHP 8.2 support, refactoring), **v1.1.0** is recommended.

### 2. **Create/Update CHANGELOG.md**

Create a CHANGELOG.md file documenting the changes:

```markdown
# Changelog

All notable changes to this project will be documented in this file.

## [1.1.0] - 2024-XX-XX

### Added
- PHP 8.2 support
- Design patterns implementation (Strategy, Factory, Repository)
- Laravel Pint for code style enforcement
- Separate ServiceProviders directory for better organization
- Comprehensive interfaces and contracts

### Changed
- Refactored codebase with design patterns for better maintainability
- Separated service providers from card providers
- Improved code readability and structure
- Enhanced validation logic

### Removed
- UI support (CardBrand, CardPreview, CardPreviewBuilder)
- Removed UI-related methods from CardDetective class

### Fixed
- Provider detection order issues
- Security code validation logic
- Card number masking logic
```

### 3. **Commit All Changes**

```bash
# Make sure all changes are committed
git add .
git commit -m "Prepare for v1.1.0 release"
git push origin master
```

### 4. **Create and Push Git Tag**

```bash
# Create an annotated tag
git tag -a v1.1.0 -m "Release v1.1.0: Design patterns, PHP 8.2 support, and code improvements"

# Push the tag to GitHub
git push origin v1.1.0
```

**Or use lightweight tag:**
```bash
git tag v1.1.0
git push origin v1.1.0
```

### 5. **Create Release on GitHub**

#### Option A: Using GitHub Web Interface

1. Go to your repository on GitHub
2. Click on **"Releases"** (right sidebar or `/releases` page)
3. Click **"Draft a new release"**
4. Fill in:
   - **Tag version**: `v1.1.0` (select from dropdown or create new)
   - **Release title**: `v1.1.0 - Design Patterns & PHP 8.2 Support`
   - **Description**: Copy from CHANGELOG.md or write release notes
   - **Attach binaries**: (optional) if you have compiled files
5. Check **"Set as the latest release"** if this is your latest
6. Click **"Publish release"**

#### Option B: Using GitHub CLI

```bash
# Install GitHub CLI if not installed
# Then create release:
gh release create v1.1.0 \
  --title "v1.1.0 - Design Patterns & PHP 8.2 Support" \
  --notes "$(cat CHANGELOG.md)"
```

### 6. **Release Notes Template**

Here's a template you can use for the release description:

```markdown
## 🚀 What's New in v1.1.0

### ✨ Major Improvements
- **Design Patterns**: Implemented Strategy, Factory, and Repository patterns for better code organization
- **PHP 8.2 Support**: Now supports PHP 8.1 and 8.2
- **Code Quality**: Added Laravel Pint for consistent code style
- **Better Architecture**: Separated service providers from card providers

### 🔧 Changes
- Refactored codebase with modern design patterns
- Improved code readability and maintainability
- Enhanced validation logic
- Better separation of concerns

### 🗑️ Removed
- UI support components (CardBrand, CardPreview, CardPreviewBuilder)
- UI-related methods from CardDetective class

### 📦 Installation

```bash
composer require carddetective/card-provider-detector:^1.1
```

### 📚 Documentation
Full documentation available in the README.md file.

### 🧪 Testing
All 39 tests passing with 78 assertions.
```

### 7. **Verify Release**

After creating the release:
1. Check that the tag appears on GitHub
2. Verify the release page looks correct
3. Test installation: `composer require carddetective/card-provider-detector:^1.1`

### Quick Command Summary

```bash
# 1. Update CHANGELOG.md (create if doesn't exist)
# 2. Commit changes
git add .
git commit -m "Prepare for v1.1.0 release"
git push origin master

# 3. Create and push tag
git tag -a v1.1.0 -m "Release v1.1.0: Design patterns, PHP 8.2 support, and code improvements"
git push origin v1.1.0

# 4. Create release on GitHub (via web interface or CLI)
gh release create v1.1.0 --title "v1.1.0 - Design Patterns & PHP 8.2 Support" --notes-file CHANGELOG.md
```

## Version Numbering Guidelines

- **MAJOR.MINOR.PATCH** (Semantic Versioning)
- **PATCH** (1.0.4): Bug fixes, no breaking changes
- **MINOR** (1.1.0): New features, backward compatible
- **MAJOR** (2.0.0): Breaking changes

## Best Practices

1. ✅ Always update CHANGELOG.md before releasing
2. ✅ Use annotated tags for better release notes
3. ✅ Write clear, descriptive release notes
4. ✅ Test the package after tagging
5. ✅ Update composer.json version if you add a version field
6. ✅ Keep release notes user-friendly and informative

